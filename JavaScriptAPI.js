/* JavaScript API for interacting with MediaWiki. The MediaWiki API for PHP is great, and it allows
 * for JSON responses. This JavaScript API allows for interacting with that API from a web browser.
 * Why use an intermediary scripting layer, just call the MediaWiki API right on the page. Probably
 * because no one else was crazy enough to write an API in JavaScript. :)
 *
 * The heart of the class is the apiCall function, which is the interface to the API directly. You
 * can use it directly and issue your own API calls to MediaWiki, or use one of the convenience
 * wrappers that wrap up common tasks into a tidy bundle.
 *
 * @author Nick Sullivan nick at sullivanflock.com
 *
 * Conventions used:
 * * Syntax checked with jslint. If you submit changes, please run them through there.
 *
 * * Careful variable scoping, every member variable is local, persistent variables are member
 *   variables of the JavaScriptAPI object
 *
 *
 * Notes:
 * * This script is really just a thin interface to the PHP API, so use it's documentation for API
 *   calls - http://www.mediawiki.org/wiki/API
 *
 * * Requires jQuery, http://jquery.com/ mostly for the underlying http work.
 *
 * * There are a few programming convenince methods included such as 'print_r' and 'empty', check
 *   them out too.
 *
 * * This is the full version with comments and all the goodies.
 *
 * * Contributions ENCOURAGED - please e-mail nick at sullivanflock.com
 *
 * * Firebug and debugLevel > 0 is your friend.
 *
 * * There is a MediaWiki status bar supplied that's helpful for letting the user know what's up
 *
 * TODO:
 * * i18n of the messages
 * * More convenience wrappers
 * * Create some regression tests
 * * Clean up the whitespace to be uniform
 * * After regression tests are made, see if the code can be refactored to look more like OO JS
 * (check to see if JavaScriptAPI is already defined, define the function inside of JavaScriptAPI's {}).
 */

var JavaScriptAPI = {
	// apiUrl must be on the same domain for write access
	apiUrl: wgScriptPath + '/api.php',

	// How long to wait for request, in milliseconds
	apiTimeout: 30000,

	// The higher the number, the more info. See JavaScriptAPI.debug
	debugLevel: 2,

	// http://www.mediawiki.org/wiki/Manual:$wgCookiePrefix
	cookiePrefix: null,

	// if using http://www.mediawiki.org/wiki/Manual:$wgCookieHttpOnly
	cookiePrefixApi: 'jsapi',

	// cookies used by the login
	cookieNames: [ 'UserID', 'UserName', 'Token', '_session' ]
};

/*** Methods are in alphabetical order. ***/

/* Issue an http request to the API, based on jQuery's ajax().
 * @param "apiParams" is an object of the params that are passed to the API, as defined in the
 * 	   JavaScriptAPI documentation
 * @param callbackSuccess/Error params are the callbacks for success/failure
 * 	   Note: If no callbackSuccess function is supplied, then syncronous (blocking) mode will
 * 	   be used, and the response will be returned directly.
 * @param method is POST or GET
 * @param ajaxParams is an object that contains key values to be passed to jQuery's ajax function
 * @return either the ajax handle if using callbacks, or the actual data if no callbacks supplied
 */
JavaScriptAPI.apiCall = function( apiParams, callbackSuccess, callbackError, method, ajaxParams ) {
	try {
		// Hard code the "json" parameter to the API call
		apiParams.format = 'json';

		var p = {
			'url': JavaScriptAPI.apiUrl,
			'data': apiParams,
			'type': method || 'GET',
			'timeout': JavaScriptAPI.apiTimeout
		};

		// Callbacks
		if ( typeof callbackSuccess == 'function' ) {
			// trigger an error when JSON is empty / malformed (BugID: 1702)
			p.success = function( data ) {
				if ( data ) {
					callbackSuccess( data );
				} else {
					p.error();
				}
			};
		} else {
			p.async = false;
			JavaScriptAPI.waiting( JavaScriptAPI.apiTimeout );
		}
		if ( typeof callbackError == 'function' ) {
			p.error = callbackError;
		} else {
			p.error = JavaScriptAPI.error;
		}

		// Tell jQuery that the result is json so it returns a JavaScript object
		p.dataType = 'json';

		// ajaxParams
		if ( typeof ajaxParams == 'object' ) {
			for ( var param in ajaxParams ) {
				p[param] = ajaxParams[param];
			}
		}

		// POST vs GET
		if ( p.type == 'GET' ) {
			// Don't confuse p.data with p.diddy. He gets mad.
			p.url += '?' + JavaScriptAPI.buildQueryString( p.data );
			p.data = null;
			JavaScriptAPI.d( 'Fetching ' + p.url, 2 );
		} else {
			JavaScriptAPI.d( 'POSTing data to ' + p.url, 2, p.data );
		}

		var r = jQuery.ajax( p );

		// For async requests, parse the data.
		// If not, the callbacks will receive an object passed to the callback
		if ( p.async === false ) {
			JavaScriptAPI.waitingDone();
			if ( typeof r == 'object' && !JavaScriptAPI.e( r.responseText ) ) {
				return JavaScriptAPI.json_decode( r.responseText );
			} else {
				return false;
			}
		}

	} catch ( e ) {
		JavaScriptAPI.error( 'API error' );
		JavaScriptAPI.d( 'API error: ' + JavaScriptAPI.print_r( e ) );
		return false;
	}
};

/* Build up a query string from the supplied array (nvpairs).
 * @param nvpairs - an assoc array (JavaScript object) containing name/value pairs
 * @param sep - the separator to use in between the values. Default "&"
 * @param - URL-encoded query string; empty if nvpairs is empty
 */
JavaScriptAPI.buildQueryString = function( nvpairs, sep ) {
	if ( JavaScriptAPI.e( nvpairs ) ) {
		return '';
	}
	if ( JavaScriptAPI.e( sep ) ) {
		sep = '&';
	}

	var out = '';
	for ( var name in nvpairs ) {
		out += sep + name + '=' + encodeURIComponent( nvpairs[name] );
	}

	return out.substring( sep.length );
};


/* Take a look at the result from the API call. If it looks ok, return true.
 * Otherwise, return the error message
 */
JavaScriptAPI.checkResult = function( result ) {
	if ( typeof result != 'object' || ( !result ) ) {
		// This isn't going to work out
		return 'Error processing result';
	} else if ( result.error ) {
		return result.error.info;
	} else {
		return true;
	}
};

/* Set/get cookies. Thanks to http://plugins.jquery.com/project/Cookie
 * Note this won't work to read JavaScriptAPI cookies if you have httpcookies set in JavaScriptAPI.
 */
JavaScriptAPI.cookie = function( name, value, options ) {
    if ( typeof value != 'undefined' ) { // name and value given, set cookie
		JavaScriptAPI.d( 'Setting ' + name + ' cookie, with a value of ' + value );
		options = options || {};
		if ( JavaScriptAPI.e( value ) ) {
			value = '';
			options.expires = -1;
		}
		var expires = '';
		if ( options.expires && ( typeof options.expires == 'number' || options.expires.toUTCString ) ) {
			var d;
			if ( typeof options.expires == 'number' ) {
				d = new Date();
				d.setTime( d.getTime() + ( options.expires ) );
			} else {
				d = options.expires;
			}
			// use expires attribute, max-age is not supported by IE
			expires = '; expires=' + d.toUTCString();
		}
		// CAUTION: Needed to parenthesize options.path and options.domain
		// in the following expressions, otherwise they evaluate to undefined
		// in the packed version for some reason...
		var path = options.path ? '; path=' + ( options.path ) : '';
		var domain = options.domain ? '; domain=' + ( options.domain ) : '';
		var secure = options.secure ? '; secure' : '';
		return document.cookie = [name, '=', encodeURIComponent( value ), expires, path, domain, secure].join( '' );
    } else { // only name given, get cookie
		var cookieValue = null;
		if ( !JavaScriptAPI.e( document.cookie ) ) {
			var cookies = document.cookie.split( ';' );
			for ( var i = 0; i < cookies.length; i++) {
				var cookie = jQuery.trim( cookies[i] );
				// Does this cookie string begin with the name we want?
				if ( cookie.substring( 0, name.length + 1 ) == ( name + '=' ) ) {
					cookieValue = decodeURIComponent( cookie.substring( name.length + 1 ) );
					break;
				}
			}
		}
		return cookieValue;
    }
};

/* Send a message to the debug console if available, otherwise alert */
JavaScriptAPI.debug = function( msg, level ) {
	if ( JavaScriptAPI.e( JavaScriptAPI.debugLevel ) ) {
		return false;
	} else if ( level > JavaScriptAPI.debugLevel ) {
		return false;
	}

	// Firebug enabled
	if ( typeof console != 'undefined' && typeof console.firebug != 'undefined' ) {
		console.log( 'MediaWiki JavaScriptAPI: ' + msg );
		if ( JavaScriptAPI.d.arguments.length > 2 ) {
			console.dir( JavaScriptAPI.d.arguments[2] );
		}
	} else if ( typeof console != 'undefined' && typeof console.log != 'undefined' ) {
		console.log( 'MediaWiki JavaScriptAPI: ' + msg );
		if ( JavaScriptAPI.d.arguments.length > 2 ) {
			console.log( JavaScriptAPI.print_r( JavaScriptAPI.d.arguments[2] ) );
		}
	}
	// No solution right now for browsers that don't have console

	return true;
};
JavaScriptAPI.d = JavaScriptAPI.debug; // Shortcut to reduce size of JS

/* Convenience wrapper for deleting an article. Obtains a token and then deletes */
JavaScriptAPI.deleteArticle = function( title, reason, callbackSuccess, callbackError ) {
	try {
		var token = JavaScriptAPI.getToken( title, 'delete' );
		if ( token === false ) {
			JavaScriptAPI.error( 'Error obtaining delete token, delete failed' );
			return false;
		}

		var apiParams = {
			'token': token,
			'action': 'delete',
			'title': title,
			'reason': reason
		};

		return JavaScriptAPI.apiCall( apiParams, callbackSuccess, callbackError, 'POST' );
	} catch ( e ) {
		JavaScriptAPI.error( 'Error deleting article' );
		JavaScriptAPI.d( JavaScriptAPI.print_r( e ) );
		return false;
	}
};

/* Main interface for editing/creating articles. The "article" param is an object contaiing
 * any of the properties listed in the api on:
 * http://www.mediawiki.org/wiki/API:Edit_-_Create%26Edit_pages
 * Of particular interest:
 *	title
 *	text
 *	section
 *	summary
 *	createonly/nocreate
 *	watch/unwatch
 */
JavaScriptAPI.editArticle = function( article, callbackSuccess, callbackError ) {
	try {
		var token = JavaScriptAPI.getToken( article.title, 'edit' );
		if ( token === false ) {
			JavaScriptAPI.error( 'Error obtaining edit token, edit failed' );
			return false;
		}

		var apiParams = {
			'token': token,
			'action': 'edit'
		};

		// Pass thru
		for ( var key in article ) {
			apiParams[key] = article[key];
		}

		return JavaScriptAPI.apiCall( apiParams, callbackSuccess, callbackError, 'POST' );
	} catch ( e ) {
		JavaScriptAPI.error( 'Error editing article' );
		JavaScriptAPI.d( JavaScriptAPI.print_r( e ) );
		return false;
	}
};

/* Emulate php's empty(). Thanks to:
 * http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_empty/
 * Nick wrote: added the check for empty arrays
 * Nick wrote: added the check for number that is NaN
 */
JavaScriptAPI.empty = function ( v ) {
    if (
		v === '' ||
		v === 0 ||
		v === null ||
		v === false ||
		typeof v === 'undefined' ||
		( typeof v === 'number' && isNaN( v ) )
	)
	{
		return true;
    } else if ( typeof v === 'object' ) {
		for ( var key in v ) {
			if ( typeof v[key] !== 'function' ) {
				return false;
			}
		}
		return true;
    } else if ( typeof v === 'array' && v.length === 0 ) {
		return true;
    }
    return false;
};
JavaScriptAPI.e = JavaScriptAPI.empty; // Shortcut to make the Javascript smaller


/* Default handler for errors from the API */
JavaScriptAPI.error = function( msg ) {
	if ( typeof msg == 'object' ) {
		msg = JavaScriptAPI.print_r( msg );
	}

	JavaScriptAPI.updateStatus( msg, true );
	JavaScriptAPI.d( msg );
};


/* Convenience wrapper for getting the end URL for a redirect. Will use cache if allowed */
JavaScriptAPI.followRedirect = function( title, useCache ) {
	try {
		if ( typeof useCache == 'undefined' ) {
			useCache = true;
		}

		if ( JavaScriptAPI.e( JavaScriptAPI.redirectCache ) ) {
			JavaScriptAPI.redirectCache = {};
		}

		if ( useCache && !JavaScriptAPI.e( JavaScriptAPI.redirectCache[title] ) ) {
			// Score!
			return JavaScriptAPI.redirectCache[title];
		}

		var responseData = JavaScriptAPI.apiCall({
			'action': 'query',
			'prop': 'info',
			'titles': title,
			'intoken': 'edit',
			'redirects': true
		});

		var out, cresult = JavaScriptAPI.checkResult( responseData );
		if ( cresult !== true ) {
			JavaScriptAPI.error( 'Error resolving redirect: ' + cresult );
			return false;
		}

		if ( !JavaScriptAPI.e( responseData.query ) && JavaScriptAPI.empty( responseData.query.redirects ) ) {
			out = title;
		} else {
			out = responseData.query.redirects[0]['to'];
		}

		// Store in cache
		JavaScriptAPI.redirectCache[title] = out;

		return out;

	} catch ( e ) {
		JavaScriptAPI.error( 'Error resolving redirect' );
		JavaScriptAPI.d( JavaScriptAPI.print_r( e ) );
		return false;
	}
};

/* The MediaWiki login cookies are prefixed.
 * Look to see if we can figure it out by looking at the cookie.
 * null will be returned if there is no matching cookies, otherwise the string
 */
JavaScriptAPI.getCookiePrefix = function() {
	// Try to determine it automagically with hokey regexp. Could [should?] we query the API?
	for ( var i = 0; i < JavaScriptAPI.cookieNames.length; i++ ) {
		var reg = new RegExp( '([^ ;]*)' + JavaScriptAPI.cookieNames[i] + '=[^;]' );
		var match = document.cookie.match( reg );
		if ( match === null ) {
			return null;
		}
	}

	// If it got this far, all the cookies were found, and match[1] contains the cookie prefix
	return match[1];
};

/* For the supplied wiki image, return the full URL for including it in HTML.
 * @return URL or false on error
 */
JavaScriptAPI.getImageUrl = function( image ) {
	if ( !image.match( /:/ ) ) {
		image = 'File:' + image;
	}

	var apiParams = {
		'action': 'query',
		'titles': image,
		'prop': 'imageinfo',
		'iiprop': 'url'
	};

	var result = JavaScriptAPI.apiCall( apiParams );
	var cresult = JavaScriptAPI.checkResult( result );
	if ( cresult !== true ) {
		JavaScriptAPI.error( 'API error pulling image URL: ' + cresult );
		return false;
	}

	try {
		for ( var pageid in result.query.pages ) {
			return result.query.pages[pageid].imageinfo[0].url;
		}
		return false;
	} catch ( e ) {
		JavaScriptAPI.e( 'Error pulling image URL: ' + JavaScriptAPI.print_r( e ) );
		return false;
	}
};

/* There is a set of cleanup that MediaWiki does to user generated article title.
 * For example, changing spaces to underscores, capitalization of certain characters,
 * removal of others. Issue a call to the API to handle this translation
 */
JavaScriptAPI.getNormalizedTitle = function( title ) {
	if ( JavaScriptAPI.e( JavaScriptAPI.normalizedTitles ) ) {
		JavaScriptAPI.normalizedTitles = {};
	}

	if ( !JavaScriptAPI.e( JavaScriptAPI.normalizedTitles[title] ) ) {
		// Score!
		return JavaScriptAPI.normalizedTitles[title];
	}

	JavaScriptAPI.d( 'Getting normalized title for ' + title );
	// TODO: is there a cheaper way to get this?
	var responseData = JavaScriptAPI.apiCall({
		'action': 'query',
		'prop': 'info',
		'titles': title,
		'intoken': 'edit'
	});

	var cresult = JavaScriptAPI.checkResult( responseData );
	if ( cresult !== true ) {
		JavaScriptAPI.error( 'API error normalizing title: ' + cresult );
		return false;
	}

	// We can get two different responses back here.
	// If it's a valid title, then it returns it directly
	// If not, it returns it "normalized".
	// If your page title isn't coming through the API, try normalizeTitle first
	var out;
	try {
		out = responseData.query.normalized[0]['to'];
	} catch ( e ) {
		out =  title;
	}

	// Save in cache
	JavaScriptAPI.normalizedTitles[title] = out;
	return out;
};


/* Obtain a token for the supplied tokenType (edit, delete, etc).
 * This is the first step in a few of the write operations, particularly those
 * dealing with articles.
 * @param title (could supprt multiple if someone wants to build it out)
 * @tokenType - type of token. Example "edit"
 */
JavaScriptAPI.getToken = function( titles, tokenType ) {
	if ( typeof titles == 'array' ) {
		JavaScriptAPI.error( 'Sorry, multiple titles not yet supported for getToken' );
	}

	JavaScriptAPI.d( 'Getting ' + tokenType + ' token for ' + titles );

	var responseData = JavaScriptAPI.apiCall({
		'action': 'query',
		'prop': 'info',
		'titles': titles,
		'intoken': tokenType
	});

	var cresult = JavaScriptAPI.checkResult( responseData );
	if ( cresult !== true ) {
		JavaScriptAPI.error( 'API error obtaining token: ' + cresult );
		return false;
	}

	// We can get two different responses back here. If it's a valid title, then it returns it
	// directly If not, it returns it "normalized".
	if ( !JavaScriptAPI.e( responseData.query ) && !JavaScriptAPI.empty( responseData.query.pages ) ) {
		if ( !JavaScriptAPI.e( responseData.query.normalized ) ) {
			// If your page title isn't coming through the API, try normalizeTitle first
			return false;
		}
		for ( var artid in responseData.query.pages ) {
			return responseData.query.pages[artid][tokenType + 'token'];
		}
	}
	return false;
};


/* Check the current page, and then the cookies for login information.
 * @return username if logged in, otherwise false
 */
JavaScriptAPI.isLoggedIn = function() {
	if ( !JavaScriptAPI.e( JavaScriptAPI.UserName ) ) {
		return JavaScriptAPI.UserName;
	}

	var cookiePrefix = JavaScriptAPI.getCookiePrefix();
	if ( cookiePrefix === null ) {
		return false;
	} else {
		JavaScriptAPI.pullLoginFromCookie( cookiePrefix );
		return JavaScriptAPI.UserName;
	}
};

/* Simple convenience wrapper for JSON parsing.
 * It will be nice when most browsers support JSON natively.
 * For now it's just IE 8+, Safari 4+, Firefox 3.1+
 * http://tinyurl.com/n5qnlb
 */
JavaScriptAPI.json_decode = function( json ) {
	if ( typeof JSON != 'undefined' ) {
		// For browsers that support it, it's more better.
		return JSON.parse( json );
	} else {
		try {
			var anon;
			eval( 'anon = ' + json + ';' );
			return anon;
		} catch ( e ) {
			JavaScriptAPI.error(
				"Error parsing json string '" + json + "'. Details: " +
				JavaScriptAPI.print_r( e )
			);
			return false;
		}
	}
};

/* Take a look at the cookies for the login info
 * Note this won't work to read MediaWiki cookies if you have httpcookies set in MediaWiki.
 */
JavaScriptAPI.pullLoginFromCookie = function( cookiePrefix ) {
	for ( var i = 0; i < JavaScriptAPI.cookieNames.length; i++ ) {
		var cookieName = JavaScriptAPI.cookieNames[i];
		JavaScriptAPI[cookieName] = JavaScriptAPI.cookie( cookiePrefix + cookieName );
	}
};

/* Convenience wrapper for http://www.mediawiki.org/wiki/API:Login
 * On the first call, just ignore the token, cookiePrefix, and sessionId.
 * Those will be filled in automatically.
 */
JavaScriptAPI.login = function( username, password, callbackSuccess, callbackError, token, cookiePrefix, sessionId ) {
	if ( JavaScriptAPI.isLoggedIn() ) {
		JavaScriptAPI.d( 'You are already logged in' );
		return null;
	}

	var apiParams = {
		'action': 'login',
		'lgname': username,
		'lgpassword': password,
		'lgtoken': ( token ? token : '' ),
		'cookieprefix': ( cookiePrefix ? cookiePrefix : '' ),
		'sessionid': ( sessionId ? sessionId : '' )
	};
	JavaScriptAPI.loginCallbackSuccess = callbackSuccess;
	JavaScriptAPI.loginCallbackError = callbackError;

	// Since newer MediaWikis will have a response of NeedToken, store the values for resubmission:
	JavaScriptAPI.loginUsername = username;
	JavaScriptAPI.loginPassword = password;

	JavaScriptAPI.waiting();
	return JavaScriptAPI.apiCall( apiParams, JavaScriptAPI.loginCallback, callbackError, 'POST' );
};

JavaScriptAPI.loginCallback = function( result ) {
	JavaScriptAPI.waitingDone();

	var cresult = JavaScriptAPI.checkResult( result );
	if ( cresult !== true ) {
		JavaScriptAPI.error( 'API Error logging in: ' + cresult );
		return;
	}

	try {
		if ( result.login.result == 'Success' ) {
			// It seems safer for the user's password to clear it out of the JS
			// variable now that it isn't needed for resubmission anymore.
			JavaScriptAPI.loginPassword = '';

			JavaScriptAPI.setLoginSession( result.login );
			JavaScriptAPI.runCallback( JavaScriptAPI.loginCallbackSuccess );

		} else if ( result.login.result == 'WrongPass' || result.login.result == 'EmptyPass' ||
			   result.login.result == 'WrongPluginPass' ) {
			JavaScriptAPI.runCallback( JavaScriptAPI.loginCallbackError, 'Invalid Password' );
		} else if ( result.login.result == 'NotExists' || result.login.result == 'Illegal' ||
			   result.login.result == 'NoName' ) {
			JavaScriptAPI.runCallback( JavaScriptAPI.loginCallbackError, 'Invalid Username' );
		} else if ( result.login.result == 'NeedToken' ) {
			var token = result.login.token;
			var cookiePrefix = result.login.cookieprefix;
			var sessionId = result.login.sessionid;
			JavaScriptAPI.d( 'Got login token, resubmitting with token...' );
			JavaScriptAPI.login(
				JavaScriptAPI.loginUsername,
				JavaScriptAPI.loginPassword,
				JavaScriptAPI.loginCallbackSuccess,
				JavaScriptAPI.loginCallbackError,
				token,
				cookiePrefix,
				sessionId
			);
		} else {
			JavaScriptAPI.error( 'Unexpected response from API when logging in: ' + result.login.result );
			throw ( 'Unexpected response from API when logging in' );
		}
	} catch ( e ) {
		// JavaScript error processing login
		JavaScriptAPI.error( 'JavaScript error logging in...' );
		JavaScriptAPI.d( JavaScriptAPI.print_r( e ) );
	}
};

/* Convenience wrapper for http://www.mediawiki.org/wiki/API:Logout */
JavaScriptAPI.logout = function( callbackSuccess ) {
	JavaScriptAPI.apiCall( {'action': 'logout'}, callbackSuccess );

	var cookiesToo = false;
	if ( JavaScriptAPI.getCookiePrefix() == JavaScriptAPI.cookiePrefixApi ) {
		cookiesToo = true;
	}
	// Clear member variables
	for ( var i = 0; i < JavaScriptAPI.cookieNames.length; i++ ) {
		var cookieName = JavaScriptAPI.cookieNames[i];
		JavaScriptAPI[cookieName] = null;

		// If the API cookie prefix is used, then clear those cookies as well
		if ( cookiesToo ) {
			JavaScriptAPI.cookie( JavaScriptAPI.cookiePrefixApi + cookieName, '' );
		}
	}
};

/*
 * Get info about the module or querymodule passed in.
 *
 * @param paramName - the parameter to send to the query.  Valid choices are eg: 'modules', 'querymodules', 'formatmodules'.
 * @param paramValue - the string to send as the value for the 'paramName'. For example if the paramName is 'modules' and the paramValue is 'bob' then the API will get 'modules=bob'.
 *
 * Example: to handle the array of all of the param's in the callback (the useful info): $().log(result.paraminfo.modules[0].parameters);
 */
JavaScriptAPI.paraminfo = function( paramName, paramValue, callbackSuccess, callbackError ) {
	var apiParams = {
		'action': 'paraminfo',
	};
	apiParams[paramName] = paramValue;

	//JavaScriptAPI.waiting();
	return JavaScriptAPI.apiCall( apiParams, callbackSuccess, callbackError );
}

/* Parse the selected text and return the html */
JavaScriptAPI.parse = function( text ) {
	var responseData = JavaScriptAPI.apiCall({
		'action': 'parse',
		'text': text
	}, null, null, 'POST' );

	if (
		JavaScriptAPI.e( responseData.parse ) ||
		JavaScriptAPI.e( responseData.parse.text )
	)
	{
		return false;
	} else {
		// Strip the parse comment
		return responseData.parse.text['*'].replace( /<!--[^>]*-->/, '' );
	}
};

/* JavaScript equivalent of PHP's print_r.
 * http://www.openjs.com/scripts/others/dump_function_php_print_r.php
 */
JavaScriptAPI.print_r = function( arr, level ) {
	var text = "\n", padding = '';
	if ( !level ) {
		level = 0;
	}

	// saving a crash if you try to do something silly like print_r(top);
	if ( level > 6 ) {
		return false;
	}

	// The padding given at the beginning of the line.
	for ( var j = 0;j < level + 1; j++ ) {
		padding += '	';
	}

	if ( typeof arr == 'object' ) { // Array/Hashes/Objects
		for ( var item in arr ) {
			var value = arr[item];

			if ( typeof value == 'object' ) { // If it is an array,
				text += padding + "'" + item + "' ...";
				text += JavaScriptAPI.print_r( value, level + 1 );
			} else {
				text += padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { // Strings/Chars/Numbers etc.
		text = "'" + arr + "'";
	}
	return text;
};

/* Pull article content http://www.mediawiki.org/wiki/API:Query */
JavaScriptAPI.pullArticleContent = function( title, callback, options ) {
	var apiParams = {
		'action':' query',
		'titles': title,
		'prop': 'revisions',
		'rvprop': 'content'
	};

	if ( typeof options == 'object' ) {
		// Pass thru
		for ( var option in options ) {
			apiParams[option] = options[option];
		}
	}

	// Store the callback
	JavaScriptAPI.pullArticleCallback = callback;

	return JavaScriptAPI.apiCall( apiParams, JavaScriptAPI.pullArticleContentCallback, callback );
};

JavaScriptAPI.pullArticleContentCallback = function( result ) {
	var cresult = JavaScriptAPI.checkResult( result );
	if ( cresult !== true ) {
		JavaScriptAPI.error( 'API error pulling content: ' + cresult );
		return;
	}

	try {
		if ( !JavaScriptAPI.e( result.query.pages[-1] ) ) {
			// Missing article
			JavaScriptAPI.runCallback( JavaScriptAPI.pullArticleCallback, null );
		} else {
			for ( var pageid in result.query.pages ) {
				var content = result.query.pages[pageid].revisions[0]['*'];
				break;
			}

			if ( JavaScriptAPI.e( content ) ) {
				content = null;
			}

			JavaScriptAPI.runCallback( JavaScriptAPI.pullArticleCallback, content );
		}

	} catch ( e ) {
		// JavaScript error
		JavaScriptAPI.error( 'Error during login callback' );
		JavaScriptAPI.d( JavaScriptAPI.print_r( e ) );
	}
};

// If called through the API, there are several steps. Just use action=render
JavaScriptAPI.pullArticleHtml = function( title, callback ) {
	var urlParams = {
		'action': 'render',
		'title': title
	};

	return jQuery.get( JavaScriptAPI.apiUrl.replace( /api.php/, 'index.php' ), urlParams, callback );
};

/* Run the supplied callback, optionally with the supplied argument */
JavaScriptAPI.runCallback = function( callback, arg ) {
	var parens = '()';
	if ( typeof arg != 'undefined' ) {
		parens = '(arg)';
	}
	if ( typeof callback == "string" && typeof window[callback] == 'function' ) {
		return eval( callback + parens + ';' );
	} else if ( typeof callback == 'function' ) {
		var anonFunc = callback;
		return eval( 'anonFunc' + parens + ';' );
	}
};

JavaScriptAPI.setLoginSession = function( vars ) {
	JavaScriptAPI.UserID = vars.lguserid;
	JavaScriptAPI.UserName = vars.lgusername;
	JavaScriptAPI._session = vars.sessionid;
	JavaScriptAPI.Token = vars.lgtoken;
	JavaScriptAPI.cookieprefix = vars.cookieprefix;

	if ( !document.cookie.match( new RegExp( JavaScriptAPI.cookieprefix + 'UserID' ) ) ) {
		// They must be using http://www.mediawiki.org/wiki/Manual:$wgCookieHttpOnly
		// Set our own cookies with a different prefix
		for ( var i = 0; i < JavaScriptAPI.cookieNames.length; i++ ) {
			var c = JavaScriptAPI.cookieNames[i];
			JavaScriptAPI.cookie( JavaScriptAPI.cookiePrefixApi + c, JavaScriptAPI[c] );
		}
	}
};

JavaScriptAPI.updateStatus = function( msg, isError, timeout ) {
	if ( JavaScriptAPI.e( JavaScriptAPI.statusBar ) ) {
		JavaScriptAPI.statusBar = new MediaWikiStatusBar();
	}

	if ( isError ) {
		JavaScriptAPI.waitingDone(); // catch all
		JavaScriptAPI.statusBar.show( msg, timeout || 30000, true );
	} else {
		JavaScriptAPI.statusBar.show( msg, timeout || JavaScriptAPI.apiTimeout, false );
	}
};

/* Indicate to the user that the API is working (change the cursor ) */
JavaScriptAPI.waiting = function( timeout ) {
	$( 'body' ).css( 'cursor', 'wait' );
	timeout = timeout || JavaScriptAPI.apiTimeout;
	window.setTimeout( function() { JavaScriptAPI.waitingDone(); }, timeout);
};

JavaScriptAPI.waitingDone = function() {
	$( 'body' ).css( 'cursor', 'auto' );
};

/* A status bar at the bottom of the window that let's the user know what's going on.
 * Thanks to http://www.west-wind.com/WebLog/posts/388213.aspx
 */
var MediaWikiStatusBar = function( sel, options ) {
	var _I = this;
	var _sb = null;

	// options
	this.elementId = '_showstatus';
	this.prependMultiline = true;
	this.showCloseButton = true;
	this.closeTimeout = 5000;

	this.cssClass = 'statusbar';
	this.errorClass = 'statusbarerror';
	this.closeButtonClass = 'statusbarclose';
	this.additive = false;

	$.extend( this, options );

	if ( sel ) {
		_sb = $( sel );
	}

	// create statusbar object manually
	if ( !_sb ) {
		_sb = $(
			'<div id="_statusbar" class="' + _I.cssClass + '">' +
		    '<div class="' + _I.closeButtonClass + '">' +
		    ( _I.showCloseButton ? ' </div></div>' : '' )
		).appendTo( document.body ).show();
	}

	if ( _I.showCloseButton ) {
		$( '.' + _I.cssClass ).click( function( e ) { $( _sb ).fadeOut(); } );
	}

	this.show = function( message, timeout, isError ) {
		if ( _I.additive ) {
			var html = '<div style="margin-bottom: 2px;">' + message + '</div>';
			if ( _I.prependMultiline ) {
				_sb.prepend( html );
			} else {
				_sb.append( html );
			}
		} else {
			if ( !_I.showCloseButton ) {
			 	_sb.text( message );
			} else {
				var t = _sb.find( 'div.statusbarclose' );
				_sb.text( message ).prepend( t );
			}
		}

		if ( isError ) {
		    _sb.addClass( _I.errorClass );
		} else {
		    _sb.removeClass( _I.errorClass );
		}

		_sb.show();

		timeout = timeout || _I.closeTimeout;
		if ( timeout ) {
			window.setTimeout( function() { _I.release(); }, timeout );
		}

	};

	this.release = function() {
		if( JavaScriptAPI.statusBar ) {
			$( _sb ).fadeOut( 'slow' );
		}
	};
};