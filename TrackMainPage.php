<?php
/**
 * Track MainPage Extension - track link clicks on the Main Page
 *
 * @file
 * @ingroup Extensions
 * @version 1.0 (r22337)
 * @author Przemek Piotrowski (Nef) <ppiotr@wikia-inc.com>
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is an extension to the MediaWiki software and cannot be used standalone.' );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'name' => 'TrackMainPage',
	'version' => '1.0',
	'author' => 'Przemek Piotrowski (Nef)',
	'description' => 'Track link clicks on the Main Page',
	'svn-date' => '$LastChangedDate: 2010-06-07 12:08:27 +0000 (Mon, 07 Jun 2010) $',
	'svn-revision' => '$LastChangedRevision: 22337 $',
);

$wgHooks['SkinAfterBottomScripts'][] = 'wfTrackMainPageHook';

function wfTrackMainPageHook( $skin, &$text ) {
	global $wgRequest;

	if (
		( Title::newMainPage()->getArticleId() == $skin->getTitle()->getArticleId() ) &&
		( $wgRequest->getVal( 'action', 'view' ) == 'view' )
	)
	{
		$text .= "<script type=\"text/javascript\">/*<![CDATA[*/
			var wgServerRE      = new RegExp( '^' + wgServer.replace( /\\\\/, '\\\\' ) );
			var wgArticlePathRE = new RegExp( '^' + wgArticlePath.replace( /\\$1/, '' ).replace( /\\\\/, '\\\\' ) );
			$( '#bodyContent a[href]' ).each( function( e ) {
				//$( this ).css( 'background-color', 'yellow' );
				if ( $( this ).parent().attr( 'class' ) == 'usermessage' ) {
					// skip 'you have new mesages on wiki foo' box
				} else {
					var tracker = $( this ).attr( 'href' )
						.replace( wgServerRE, '' )
						.replace( wgArticlePathRE, '' )
						.replace( /[\\/?&]/g, '_' );
					$( this ).bind( 'click',
						function( e ) {
							WET.byStr( 'mainpage/' + tracker );
						}
					);
				}
			});
		/*]]>*/</script>\n";
	}

	return true;
}