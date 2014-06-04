<?php
/**
 * AdsenseForSearch extension - renders Google AdSense ads on search result pages
 *
 * @file
 * @ingroup Extensions
 * @version 1.0 (r9529)
 * @author Christian Williams <christian@wikia-inc.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @link https://www.mediawiki.org/wiki/Extension:AdsenseForSearch Documentation
 */

/**
 * Protect against register_globals vulnerabilities.
 * This line must be present before any global variable is referenced.
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	die( "This is not a valid entry point.\n" );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'name' => 'AdsenseForSearch',
	'author' => 'Christian Williams',
	'version' => '1.0',
	'url' => 'https://www.mediawiki.org/wiki/Extension:AdsenseForSearch',
	'description' => 'Renders Google AdSense ads on search result pages',
);

function renderAdsenseForSearch( $format = 'w2n8', $channel = '2226605464' ) {
	global $wgAFSKeywords;
	echo <<<EOS
	<div id="afs_narrow" class="google_afs"></div>
	<div id="afs_wide" class="google_afs"></div>
	<script type="text/javascript">
	$( function() {
		$( '#afs_wide' ).clone().insertAfter( '.mw-search-results:last' );
	});
	</script>

	<script language="JavaScript">
		<!--
		/**
		 * This function retrieves the search query from the URL.
		 */
		function GetParam( name ) {
			var match = new RegExp( name + "=([^&;]+)" ).exec( location.search );
			if ( match === null ) {
				match = new RegExp( name + "=(.+)", 'i' ).exec( location.search );
			}
			if ( match === null ) {
				return null;
			}

			match = match + ''; // **convert match to a string
			var result = match.split( ',' );
			return decodeURIComponent( result[1] );
		}

		/**
		 * This function is required. It processes the google_ads JavaScript object,
		 * which contains AFS ads relevant to the user's search query. The name of
		 * this function <i>must</i> be <b>google_afs_request_done</b>. If this
		 * function is not named correctly, your page will not display AFS ads.
		 */
		function google_afs_request_done( google_ads ) {
			/**
			 * Verify that there are actually ads to display.
			 */
			var google_num_ads = google_ads.length;
			if ( google_num_ads <= 0 ) {
				return;
			}

			var wideAds = ''; // wide ad unit HTML text
			var narrowAds = ''; // narrow ad unit HTML text

			for ( var i = 0; i < google_num_ads; i++ ) {
				if ( google_ads[i].type === 'text/wide' ) {
					// render a wide ad
					wideAds += '<div style="margin-top: 1em;"><a style="text-decoration:none" onmouseover="javascript:window.status=\'' +
							google_ads[i].url + '\';return true;" ' +
							'onmouseout="javascript:window.status=\'\';return true;" ' +
							'href="' + google_ads[i].url + '">' +

							'<span class="ad_line1">' + google_ads[i].line1 + '</span></a><br />' +

							'<span class="ad_text">' + google_ads[i].line2 + '</span><br />' +

							'<a style="text-decoration:none" onmouseover="javascript:window.status=\'' +
							google_ads[i].url + '\';return true;" ' +
							'onmouseout="javascript:window.status=\'\';return true;" ' +
							'href="' + google_ads[i].url + '">' +

							'<span class="ad_url mw-search-result-data">' + google_ads[i].visible_url + '</span></a></div>';
				} else {
					// render a narrow ad
					narrowAds += '<a style="text-decoration:none" onmouseover="javascript:window.status=\'' +
							google_ads[i].url + '\';return true;" ' +
							'onmouseout="javascript:window.status=\'\';return true;" ' +
							'href="' + google_ads[i].url + '">' +

							'<span class="ad_line1">' + google_ads[i].line1 + '</span></a><br />' +

							'<span class="ad_text">' + google_ads[i].line2 + '</span><br />' +

							'<span class="ad_text">' + google_ads[i].line3 + '</span><br />' +

							'<a style="text-decoration:none" onmouseover="javascript:window.status=\'' +
							google_ads[i].url + '\';return true;" ' +
							'onmouseout="javascript:window.status=\'\';return true;" ' +
							'href="' + google_ads[i].url + '">' +

							'<span class="ad_url mw-search-result-data">' + google_ads[i].visible_url + '</span><br /><br /></a>';
				}
			}

			if ( narrowAds !== '' ) {
				narrowAds = '<a style="text-decoration:none" ' +
							'href="https://www.google.com/adsense/support/bin/request.py?contact=afs_violation">' +
							'<span class="ad_header" style="text-align: left">Ads by Google</span><br /><br /></a>' + narrowAds;
			}

			if ( wideAds !== '' ) {
				wideAds = '<a style="text-decoration:none" ' +
						'href="https://www.google.com/adsense/support/bin/request.py?contact=afs_violation">' +
						'<span class="ad_header" style="text-align: left">Ads by Google</span></a>' + wideAds;
			}

			// Write HTML for wide and narrow ads to the proper <div> elements
			document.getElementById( 'afs_wide' ).innerHTML = wideAds;
			document.getElementById( 'afs_narrow' ).innerHTML = narrowAds;
		}
EOS;
	if ( !empty( $wgAFSKeywords ) ) {
		$afs_keywords = '';
		//$afs_string = str_replace( ' ', '', trim( $wgAFSKeywords ) );
		$afs_array = explode( ',', $wgAFSKeywords );
		foreach ( $afs_array as $value ) {
			$afs_keywords .= '+'. $value;
		}
		echo "google_afs_query = GetParam( 'search' ) + '" . $afs_keywords . "';\n";
	} else {
		echo "google_afs_query = GetParam( 'search' );\n";
	}

	echo "google_afs_ad = '" . $format . "'; // specify the number of ads you are requesting\n";
	echo "google_afs_channel = '" . $channel . "'; // enter your custom channel ID\n";
	echo <<<EOS
		google_afs_client = 'pub-4086838842346968'; // substitute your client ID
		google_afs_hl = 'en'; // enter your interface language if not English
		// google_afs_ie = 'UTF-8'; // select input encoding scheme
		// google_afs_oe = 'UTF-8'; // select output encoding scheme

	-->
	</script>
	<script language="JavaScript" src="http://www.google.com/afsonline/show_afs_ads.js"></script>
EOS;
}