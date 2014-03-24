<?php
/**
 * Answers skin -- new version
 *
 * @file
 * @ingroup Skins
 * @author Nick Sullivan <nick@sullivanflock.com>
 * @author Jack Phoenix <jack@countervandalism.net>
 * @copyright Copyright © 2009-2012 Nick Sullivan and Jack Phoenix
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not a valid entry point.' );
}

// Skin credits that will show up on Special:Version
$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'Answers',
	'version' => '2.0',
	'author' => array( 'Nick Sullivan', 'Jack Phoenix' ),
	'description' => 'New version of the Answers skin, based on Monaco',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Answers',
);

// Autoload the skin class, make it a valid skin, set up i18n, set up CSS & JS
// (via ResourceLoader)
$skinID = basename( dirname( __FILE__ ) );
$dir = dirname( __FILE__ ) . '/';

// The first instance must be strtolower()ed so that useskin=answers works and
// so that it does *not* force an initial capital (i.e. we do NOT want
// useskin=Answers) and the second instance is used to determine the name of
// *this* file.
$wgValidSkinNames[strtolower( $skinID )] = 'Answers';

$wgAutoloadClasses['SkinAnswers'] = $dir . 'Answers.skin.php';
$wgResourceModules['skins.answers'] = array(
	'styles' => array(
		#'extensions/Answers/NewSkin/css/ie6.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/main.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/modal.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/monaco_answers.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/monobook_modified.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/reset_modified.css' => array( 'media' => 'screen' ),
		'extensions/Answers/NewSkin/css/widget.css' => array( 'media' => 'screen' )
	),
	'scripts' => 'extensions/Answers/NewSkin/js/main.js',
	'messages' => array(
		'ask_a_question', 'in_category', 'answer_title', 'movepagebtn',
		'delete', 'save', 'categorize', 'categorize_help', 'next_page',
		'prev_page', 'more', 'quick_action_panel', 'ads_by_google', 'see_all'
	),
	'position' => 'top'
);

// Themes
$wgResourceModules['skins.answers.bluebell'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/bluebell/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.carbon'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/carbon/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.carnation'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/carnation/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.forest'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/forest/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.leaf'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/leaf/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.moonlight'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/moonlight/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.obsession'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/obsession/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.sky'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/sky/css/main.css' => array( 'media' => 'screen' )
	)
);

$wgResourceModules['skins.answers.spring'] = array(
	'styles' => array(
		'extensions/Answers/NewSkin/spring/css/main.css' => array( 'media' => 'screen' )
	)
);