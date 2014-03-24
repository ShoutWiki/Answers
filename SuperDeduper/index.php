<?php
/* Simple JSON interface to the super deduper for type-ahead completion */
header( 'Content-Type: text/plain' );
require 'SuperDeduper.class.php';
$superDeduper = new SuperDeduper( $_GET['lang'], $_GET['db'] );
if ( empty( $_GET['limit'] ) ) {
	$_GET['limit'] = 10;
}
$results = $superDeduper->getRankedMatches( @$_GET['query'], $_GET['limit'] );

$out = array();
foreach ( $results as $title => $rank ) {
	$out['ResultSet']['Result'][] = array(
		'title' => $title,
		'rank' => $rank
	);
}
echo json_encode( $out );