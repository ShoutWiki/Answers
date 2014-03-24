<?php
/**
 * HomePageList - API wrappers for answers' home page lists (recent questions
 * sidebar, main page lists etc.)
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Przemek Piotrowski (Nef) <ppiotr@wikia-inc.com>
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is not a valid entry point to MediaWiki.' );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'name' => 'HomePageList',
	'version' => '1.0',
	'author' => 'Przemek Piotrowski',
	'description' => "API wrappers for answers' home page lists (recent questions sidebar, main page lists etc.)",
	'url' => 'https://www.mediawiki.org/wiki/Extension:Answers',
);

// Autoload our main class and set up the API module used by this extension
$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses['HomePageList'] = $dir . 'HomePageList.class.php';
$wgAutoloadClasses['ApiQueryCategoriesOnAnswers'] = $dir . 'api/ApiQueryCategoriesOnAnswers.php';
$wgAPIListModules['categoriesonanswers'] = 'ApiQueryCategoriesOnAnswers';

// Register the two new parser hooks
$wgHooks['ParserFirstCallInit'][] = 'HomePageList::registerParserHooks';

$wgAjaxExportList[] = 'HomePageListAjax';
function HomePageListAjax() {
	global $wgRequest;

	$method = $wgRequest->getVal( 'method', false );

	if ( method_exists( 'HomePageList', $method ) ) {
		$data = HomePageList::$method( /* is_ajax */ true );

		if ( is_array( $data ) ) {
			$json = json_encode( $data );
			$response = new AjaxResponse( $json );
			$response->setContentType( 'application/json; charset=utf-8' );
		} else {
			$response = new AjaxResponse( $data );
			$response->setContentType( 'text/html; charset=utf-8' );
		}

		return $response;
	}
}