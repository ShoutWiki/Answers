<?php
/**
 * Translations of the Answer namespace
 *
 * @file
 */

$namespaceNames = array();

// For wikis where the Answer extension is not installed.
if ( !defined( 'NS_ANSWER' ) ) {
	define( 'NS_ANSWER', 230 );
}

if ( !defined( 'NS_ANSWER_TALK' ) ) {
	define( 'NS_ANSWER_TALK', 231 );
}

/** English */
$namespaceNames['en'] = array(
	NS_ANSWER => 'Answer',
	NS_ANSWER_TALK => 'Answer_talk',
);

/** Finnish (suomi) */
$namespaceNames['fi'] = array(
	NS_ANSWER => 'Vastaus',
	NS_ANSWER_TALK => 'Keskustelu_vastauksesta',
);

/** French (français) */
$namespaceNames['fr'] = array(
	NS_ANSWER => 'Réponse',
	NS_ANSWER_TALK => 'Discussion_réponse',
);