/**
 * JavaScript for the EditResearch extension
 */
var EditResearch = {
	wikipedia_server: 'http://' + mw.config.get( 'wgContentLanguage' ) + '.wikipedia.org',
	research_page: 0,
	research_page_limit: 10,
	current_title: '',

	getSelection: function() {
		var sel;
		if ( document.getSelection ) {
			sel = document.getSelection();
		} else if ( document.selection ) {
			sel = document.selection.createRange().text;
		} else if ( window.getSelection ) {
			sel = window.getSelection();
		}
		return sel;
	},

	research: function() {
		var search = document.getElementById( 'search_input' ).value;
		if ( !search ) {
			return;
		}

		jQuery( '#research_box' ).css( 'overflow', '' );
		jQuery( '#research-inner' ).css( 'background-color', '#FFF' ).css( 'background-image', 'none' );
		var url = EditResearch.wikipedia_server + '/w/api.php?action=query&list=search&srsearch=' +
			encodeURIComponent( search ) + '&sroffset=' +
			( EditResearch.research_page * EditResearch.research_page_limit ) +
			'&format=json&callback=?';
		jQuery.getJSON( url, '', function( data ) {
			if ( data.query ) {
				var search_html = '';
				for ( var x = 0; x <= data.query.search.length - 1; x++ ) {
					var title = data.query.search[x].title;
					// @todo FIXME
					search_html += '<div class="research-search-result"><a href="#research-search" onclick="research_wikipedia_article(this)">' +
						title + '</a></div>';
				}
				if ( search_html ) {
					search_html += '<div id="research-search-nav">' +
						( ( EditResearch.research_page > 0 ) ?
							'<a href="javascript:research_paginate(-1)">' + // @todo FIXME
							mw.msg( 'editresearch-previous' ) + '</a>' : ''
						) +
						// @todo FIXME
						' <a href="javascript:research_paginate(1)">' + mw.msg( 'next' ) + '</a></div>';
				} else {
					search_html = mw.msg( 'editresearch-no-results' );
				}
				document.getElementById( 'research_box' ).innerHTML = search_html;
			}
		} );
	},

	research_paginate: function( dir ) {
		EditResearch.research_page = EditResearch.research_page + dir;
		EditResearch.research();
	},

	research_wikipedia_article: function( node ) {
		var article = jQuery( node ).html().replace( /\s/g, '_' );

		injectSpinner( document.getElementById( 'research_box' ), 'wikipedia' );

		// sometimes Wikipedia links have a hash to point to a section...
		// need to strip that out for the API
		article = article.replace( /#.*/g, '' );

		// save for attribution
		EditResearch.current_title = article;

		document.getElementById( 'research_box' ).innerHTML = '';
		document.getElementById( 'research_box' ).style.overflow = '';
		var url = EditResearch.wikipedia_server + '/w/api.php?action=parse&page=' +
			encodeURIComponent( article ) + '&format=json&callback=?';

		jQuery.getJSON( url, '', function( data ) {
			var html = data.parse.text['*'];

			// replace all the wiki links so they point to this function
			// <a href=\"\/wiki\/Eli_Manning\"
			html = html.replace(
				/<a\shref=\"(\/wiki\/(.*?))\".*?>(.*?)<\/a>/g,
				'<a href="#research-search" onclick="research_wikipedia_article(this)">$3</a>' // @todo FIXME
			);

			// we should also remove red links and edit links
			html = html.replace( /<a\shref=\"(\/w\/index\.php\?title=(.*?)&.*?)\".*?>(.*?)<\/a>/g, '$3' );

			removeSpinner( 'wikipedia' );
			document.getElementById( 'research_box' ).style.overflow = 'scroll';
			document.getElementById( 'research_box' ).innerHTML = html;
		});
	},

	initialize: function() {
		jQuery( '#research_box' ).ready( function() {
			jQuery( '#research_box' ).mouseup( function() {
				var sel = EditResearch.getSelection();
				if ( sel ) {
					mw.loader.using( 'mediawiki.action.edit', function() {
						mw.toolbar.insertTags( '', '', sel );
					} );
					//insertTags( '', '', sel );

					if ( document.getElementById( 'wpTextbox1' ).value.indexOf( '{{wikipedia|' + EditResearch.current_title + '}}' ) === -1 ) {
						document.getElementById( 'wpTextbox1' ).value =
							document.getElementById( 'wpTextbox1' ).value +
							"\n{{wikipedia|" + EditResearch.current_title + '}}';
					}
				}
			});
			jQuery( '#search_input' ).keydown( function( e ) {
				if ( e.keyCode === 13 ) {
					EditResearch.research();
					return false;
				}
			});
		});

		jQuery( '#firstHeading' ).ready( function() {
			jQuery( '#firstHeading' ).mouseup( function() {
				var sel = EditResearch.getSelection();
				if ( sel ) {
					document.getElementById( 'search_input' ).value = sel;
					document.getElementById( 'search_input' ).focus();
					EditResearch.research();
				}
			});
		});
	}
};

jQuery( document ).ready( EditResearch.initialize );