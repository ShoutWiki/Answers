<?php
/**
 * SuperDeduper extension -- JSON interface to the super deduper for type-ahead
 * completion
 *
 * @file
 * @version 1.0
 * @author Emil Podlaszewski <emil@wikia-inc.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'] = array(
	'name' => 'SuperDeduper',
	'version' => '1.0',
	'author' => 'Emil Podlaszewski',
	'description' => 'JSON interface to the super deduper for type-ahead completion',
);

// Autoload classes and set up the new API module
$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses['SuperDeduper'] = $dir . 'SuperDeduper.class.php';
$wgAutoloadClasses['AwesomeDeduper'] = $dir . 'AwesomeDeduper.php';

$wgAutoloadClasses['ApiSuperDeduper'] = $dir . 'ApiSuperDeduper.php';

$wgAPIModules['superdeduper'] = 'ApiSuperDeduper';

$wgAjaxExportList[] = 'efGetRankedMatches';

function efGetRankedMatches() {
	global $wgRequest;
	$sd = new AwesomeDeduper(
		$wgRequest->getVal( 'lang' ),
		$wgRequest->getVal( 'db' )
	);
	$results = $sd->getRankedMatches(
		$wgRequest->getVal( 'query' ),
		$wgRequest->getVal( 'limit', 10 )
	);
	$out = array();
	foreach ( $results as $title => $rank ) {
		$out['ResultSet']['Result'][] = array(
			'title' => $title,
			'rank' => $rank
		);
	}
	$res = new AjaxResponse( json_encode( $out ) );
	$res->setCacheDuration( 3600 );
	return $res;
}