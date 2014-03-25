<?php
/**
 * Answers tools
 *
 * @file
 * @ingroup Extensions
 * @version 1.0 (r57364)
 * @date 31 July 2012
 * @author Maciej Brencz <macbre@wikia-inc.com>
 * @author Maciej Błaszkowski <marooned@wikia-inc.com>
 * @author Adrian Wieczorek <adi3ek@wikia-inc.com>
 * @author Nick Sullivan <nick@sullivanflock.com>
 * @author Sean Colombo <sean.colombo@gmail.com>
 * @author David Pean <david.pean@gmail.com>
 * @author Jack Phoenix <jack@countervandalism.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 3.0 or later
 * @link http://www.mediawiki.org/wiki/Extension:Answers Documentation
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die();
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Answers',
	'version' => '1.0',
	'author' => array(
		'Maciej Brencz', 'Maciej Błaszkowski', 'Adrian Wieczorek',
		'Nick Sullivan', 'Sean Colombo', 'David Pean', 'Jack Phoenix'
	),
	'descriptionmsg' => 'answers-desc',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Answers',
);

// Grumble grumble...
// These need to be defined here, *too*, in addition to the .namespaces.php file
// so that when AnswersHooks.php tries to use these constants, we don't get notices
// about undefined constants
if ( !defined( 'NS_ANSWER' ) ) {
	define( 'NS_ANSWER', 230 );
}

if ( !defined( 'NS_ANSWER_TALK' ) ) {
	define( 'NS_ANSWER_TALK', 231 );
}

// Set up i18n, autoload classes and include the various sub-extensions
$dir = dirname( __FILE__ ) . '/';
$wgExtensionMessagesFiles['Answers'] = $dir . 'Answers.i18n.php';
$wgExtensionMessagesFiles['AnswersNamespaces'] = $dir . 'Answers.namespaces.php';
// Didn't do anything when called in GetQuestionWidget.php
$wgExtensionMessagesFiles['GetQuestionWidget'] = dirname( __FILE__ ) . '/GetQuestionWidget/GetQuestionWidget.i18n.php';

$wgAutoloadClasses['Answer'] = $dir . 'AnswersClass.php';
$wgAutoloadClasses['AttributionCache'] = $dir . 'AttributionCache.class.php';

$wgAutoloadClasses['CustomMovePageForm'] = $dir . 'CustomMoveForm.php';
//$wgAutoloadClasses['CategoryWithAds'] = $dir . 'CategoryWithAds.php';
$wgAutoloadClasses['AnswersHooks'] = $dir . 'AnswersHooks.php';

$wgAutoloadClasses['DefaultQuestion'] = $dir . 'DefaultQuestion.php';
$wgAutoloadClasses['PrefilledDefaultQuestion'] = $dir . 'PrefilledDefaultQuestion.php';
$wgAutoloadClasses['CreateQuestionPage'] = $dir . 'SpecialCreateDefaultQuestionPage.php';
$wgSpecialPages['CreateQuestionPage'] = 'CreateQuestionPage';

$wgAutoloadClasses['GetQuestionWidget'] = $dir . 'GetQuestionWidget/SpecialGetQuestionWidget.php';
$wgSpecialPages['GetQuestionWidget'] = 'GetQuestionWidget';

$wgAutoloadClasses['EditResearch'] = $dir . 'EditResearch/EditResearch.php';

/**
TESTING
*/
$wgResourceModules['answers_css'] = array(
	'styles' => array( 'extensions/Answers/Skins/vector.css' => array( 'media' => 'screen' ) )
);



//include( $dir . 'customUserCreateForm.php' );
//include( $dir . 'TrackCategories.php' );
//include( $dir . 'TrackMainPage.php' );
include( $dir . 'HomePageList.php' );
include( $dir . 'EditSimilarAnswers.php' );
include( $dir . 'FakeAnswersMessaging.php' );

//include( $dir . 'SuperDeduper/SuperDeduper.php' );

$wgAnswerHelperIDs = array(
	0, /* anonymous */
	1172427 /* Wikia User */ //How the hell did they get that number? 
);

// Over 9000 hooked functions

// Add the Answers namespace
$wgHooks['CanonicalNamespaces'][] = 'AnswersHooks::createCanonicalNamespaces';

$wgHooks['AddNewAccount'][] = 'AnswersHooks::questionAttributionRegister';
$wgHooks['UserLoginComplete'][] = 'AnswersHooks::questionAttributionLogin';

$wgHooks['ArticleSaveComplete'][] = 'AttributionCache::purgeArticleContribs';
$wgHooks['TitleMoveComplete'][] = 'AttributionCache::purgeArticleContribsAfterMove';

$wgHooks['MovePageForm'][] = 'AnswersHooks::customMoveForm';
$wgHooks['TitleMoveComplete'][] = 'AnswersHooks::redirectOnMove';

/* Extension to change the display of the category page for answers
 * - Hide the title if there is no subcategory
 * - Display "unanswered" questions differently
 */
$wgHooks['CategoryViewer::getOtherSection'][] = 'AnswersHooks::categoryOtherSection';
$wgHooks['CategoryViewer::addPage'][] = 'AnswersHooks::addCategoryPage';

// For Magic Answer, override the text in the edit box if it is passed in the request
$wgHooks['EditPage::showEditForm:initial2'][] = 'AnswersHooks::displayMagicAnswer';

// injects ads into Category pages
//$wgHooks['CategoryPageView'][] = 'AnswersHooks::injectAdsToCategoryPages';

$wgHooks['GetPreferences'][] = 'AnswersHooks::addHideAttributtionToggle';
$wgHooks['CustomArticleFooter'][] = 'AnswersHooks::hideFooter';

$wgHooks['EditPage::attemptSave'][] = 'AnswersHooks::markAsAnswered';
$wgHooks['MakeGlobalVariablesScript'][] = 'AnswersHooks::addJSGlobalVariables';

// Integration with SocialProfile's UserProfile
$wgHooks['UserProfileBeginLeft'][] = 'AnswersHooks::showAskedQuestionsOnUserProfile';
$wgHooks['UserProfileBeginRight'][] = 'AnswersHooks::showAnsweredQuestionsOnUserProfile';

// Adds a question mark to the question page
$wgHooks['OutputPageParserOutput'][] = 'AnswersHooks::addQuestionMarkTitle';

// API modules
$wgAutoloadClasses['ApiQueryPagesByCategory'] = $dir . 'api/ApiQueryPagesByCategory.php';
// 1.13 version
//$wgApiQueryListModules['wkpagesincat'] = 'ApiQueryPagesByCategory';
// 1.14 version
$wgAPIListModules['wkpagesincat'] = 'ApiQueryPagesByCategory';

$wgAutoloadClasses['ApiQueryMostCategories'] = $dir . 'api/ApiQueryMostCategories.php';
// 1.13 version
//$wgApiQueryListModules['wkmostcat'] = 'ApiQueryMostCategories';
// 1.14 version
$wgAPIListModules['wkmostcat'] = 'ApiQueryMostCategories';

// register answers themes
/*
$wgSkinTheme['answers'] = array(
	'bluebell', 'leaf', 'carnation', 'sky', 'spring', 'forest', 'moonlight',
	'carbon', 'obsession', 'custom'
);
*/
include( 'NewSkin/NewSkin.php' );
$wgDefaultSkin = 'answers';
$wgDefaultTheme = 'bluebell';

// make SkinChooser work for Answers
/*
$wgSkinTheme['monobook'] = array();
$wgSkipSkins[] = 'monaco';
$wgSkipSkins[] = 'monobook';

// remove answers from $wgSkipSkins
unset( $wgSkipSkins[array_search( 'answers', $wgSkipSkins )] );
*/

// FIXME: this SHOULD NOT be here. Move to Skin.
#$wgExtensionFunctions[] = 'answersStyle';
function answersStyle() {
	global $wgOut, $wgStylePath, $wgUseNewAnswersSkin;

	if ( !empty( $wgUseNewAnswersSkin ) ) {
		$wgOut->addExtensionStyle( "{$wgStylePath}/answers/css/monaco_answers.css" );
	}

	return true;
}

//require_once( "$IP/extensions/solr2rss/solr2rss.php" );

function fnWatchHeldPage( $user ) {
	global $wgOut, $wgCookiePrefix, $wgCookieDomain, $wgCookieSecure;

	$watch_page = '';
	if ( isset( $_COOKIE["{$wgCookiePrefix}wsWatchHold"] ) ) {
		$watch_page = $_COOKIE["{$wgCookiePrefix}wsWatchHold"];
	}

	// user had clicked to watch page
	if ( isset( $watch_page ) && $watch_page != '' ) {
		$watchedTitle = Title::newFromDBkey( $watch_page );
		$user->addWatch( $watchedTitle );
		setcookie(
			"{$wgCookiePrefix}wsWatchHold",
			'',
			time() - 86400,
			'/',
			$wgCookieDomain,
			$wgCookieSecure
		);
		$wgOut->redirect( $watchedTitle->getFullURL() );
	}
}

function fnQuestionAttribution( $user ) {
	global $wgMemc;

	$dbw = wfGetDB( DB_MASTER );

	$title = Title::newFromText( $_SESSION['wsQuestionAsk'] );
	$pageTitleId = $title->getArticleID();

	// watchlist page for them
	$user->addWatch( $title );

	// get first revision ID
	$s = $dbw->selectRow(
		'revision',
		array( 'rev_id' ),
		array( 'rev_page' => $pageTitleId ),
		__METHOD__,
		array( 'ORDER BY' => 'rev_id ASC', 'LIMIT' => 1 )
	);
	$revisionId = $s->rev_id;

	// change necessary tables
	$dbw->update(
		'revision',
		/* SET */array(
			'rev_user' => $user->getId(),
			'rev_user_text' => $user->getName()
		),
		/* WHERE */array( 'rev_id' => $revisionId ),
		__METHOD__
	);
	$dbw->commit();

	$dbw->update(
		'recentchanges',
		/* SET */array(
			'rc_user' => $user->getId(),
			'rc_user_text' => $user->getName()
		),
		/* WHERE */array(
			'rc_cur_id' => $pageTitleId,
			'rc_new' => 1
		),
		__METHOD__
	);
	$dbw->commit();

	// if the page happens to get deleted in between the anon asking a question
	// and registration, we have to also update the archive
	$dbw->update(
		'archive',
		/* SET */array(
			'ar_user' => $user->getId(),
			'ar_user_text' => $user->getName()
		),
		/* WHERE */array( 'ar_title' => $title->getDBkey() ),
		__METHOD__
	);
	$dbw->commit();

	// clear cache
	$title->invalidateCache();
	$title->purgeSquid();
	$key = wfMemcKey( 'answer_author', $pageTitleId );
	$wgMemc->delete( $key );

	return true;
}

$wgAjaxExportList[] = 'wfGetCategoriesSuggest';
function wfGetCategoriesSuggest( $query, $limit = 5 ) {
	$dbr = wfGetDB( DB_SLAVE );

	$res = $dbr->select(
		'categorylinks',
		array( 'cl_to', 'COUNT(*) AS cnt' ),
		array( 'UPPER(cl_to) ' . $dbr->buildLike( strtoupper( $query ), $dbr->anyString() ) ),
		__METHOD__,
		array( 'ORDER BY' => 'cl_to', 'GROUP BY' => 'cl_to' )
	);
	foreach ( $res as $row ) {
		$title = Title::makeTitle( NS_CATEGORY, $row->cl_to );
		$out['ResultSet']['Result'][] = array(
			'category' => $title->getText(),
			'count' => $row->cnt
		);
	}

	return json_encode( $out );
}

$wgAjaxExportList[] = 'wfGetQuestionsWidget';
function wfGetQuestionsWidget( $title, $category, $limit = 5, $order = '' ) {
	global $wgServer, $wgScriptPath, $wgStylePath;

	$category = urldecode( $category );
	$category = str_replace( ' ', '%20', $category );

	$url = $wgServer . $wgScriptPath .
		"/api.php?action=query&smaxage=60&list=wkpagesincat&wkcategory=$category&wklimit=$limit&wkorder=$order&format=php";

	$questions = Http::get( $url );
	$questions = unserialize( $questions );

	// @todo FIXME: incorrect path to NewSkin
	$html = "document.write('<link rel=\"stylesheet\" type=\"text/css\" href=\"{$wgServer}{$wgStylePath}/answers/css/widget.css\" />')\n";

	$html .= "document.write('<div class=\"question_widget\" style=\"' + ( ( answers_width ) ? 'width:' + answers_width + ';' : '' ) + ( ( answers_border ) ? 'border:' + answers_border + ';' : '' ) + ( ( answers_background_color ) ? 'background-color:' + answers_background_color + ';' : '' ) + '\">')\n";
	$html .= "document.write('<div class=\"question_widget_title\"><h3>$title</h3></div>')\n";

	if ( is_array( $questions ) ) {
		$html .= "document.write('<ul style=\"\">')\n";
		foreach ( $questions['query']['wkpagesincat'] as $page ) {
			$title = Title::newFromDBkey( $page['title'] );
			$html .= "document.write('<li><a style=\"' + ( ( answers_link_color ) ? 'color:' + answers_link_color + ';' : '' ) + '\" href=\"" .
				$page['url'] . '" target="_top">' . str_replace( "'", "\'", $title->getText() ) . "?</a></li>')\n";
		}
		$html .= "document.write('</ul>')\n";
	} else {
		$html .= "document.write('<div>" . wfMsg( 'no_questions_found' ) . "</div>')";
	}

	$html .= "document.write('<div id=\"question_widget_logo\"><a href=\"$wgServer\"><img src=\"$wgServer/skins/answers/images/wikianswers_logo.png\" border=\"0\"></a></div>')\n
	document.write('</div>')";

	return $html;
}

$wgAjaxExportList[] = 'wfHoldWatchForAnon';
function wfHoldWatchForAnon( $title ) {
	global $wgCookiePrefix, $wgCookieDomain, $wgCookieSecure, $wgCookieExpiration;
	setcookie(
		$wgCookiePrefix . 'wsWatchHold',
		$title,
		time() + $wgCookieExpiration,
		'/',
		$wgCookieDomain,
		$wgCookieSecure
	);
	return SpecialPage::getTitleFor( 'Userlogin', 'signup' )->getFullURL();
}

$wgAjaxExportList[] = 'wfAnswersGetEditPointsAjax';
function wfAnswersGetEditPointsAjax() {
	global $wgRequest, $wgSquidMaxage;

	$userId = $wgRequest->getInt( 'userId' );
	$points = AttributionCache::getInstance()->getUserEditPoints( $userId );
	$timestamp = AttributionCache::getInstance()->getUserLastModifiedFromCache( $userId );
	$timestamp = !empty( $timestamp ) ? $timestamp : wfTimestampNow();

	$data = array(
		'points' => $points,
		'timestamp' => wfTimestampNow()
	);

	$json = json_encode( $data );
	$response = new AjaxResponse( $json );
	$response->setContentType( 'application/json; charset=utf-8' );
	$response->checkLastModified( strtotime( $timestamp ) );
	$response->setCacheDuration( $wgSquidMaxage );

	return $response;
}