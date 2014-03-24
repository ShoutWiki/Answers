<?php
/**
 * EditResearch extension -- adds a "research" box into edit view for
 * researching the subject
 *
 * @file
 * @ingroup Extensions
 * @version 1.0 (r13418)
 * @author David Pean <david.pean@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
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
    'name' => 'EditResearch',
	'version' => '1.0',
    'author' => 'David Pean',
	'description' => 'Adds a "research" box into edit view for researching the subject',
);

// Register the CSS & JS with ResourceLoader
$wgResourceModules['ext.EditResearch'] = array(
	'styles' => 'EditResearch.css',
	'scripts' => 'EditResearch.js',
	'messages' => array(
		'editresearch-previous', 'editresearch-no-results', 'next'
	),
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'Answers/EditResearch',
	'position' => 'top'
);

// Internationalization file
$wgExtensionMessagesFiles['EditResearch'] = dirname( __FILE__ ) . '/EditResearch.i18n.php';

$wgHooks['EditPage::showEditForm:initial'][] = 'addEditResearch';
function addEditResearch( $editPage ) {
	global $wgOut, $wgEditResearchNamespaces;

	$title = $editPage->getTitle();
	// Only add for enabled namespaces or for NS_ANSWER if $wgEditResearchNamespaces isn't defined
	if ( !empty( $wgEditResearchNamespaces ) ) {
		if ( $wgEditResearchNamespaces[$title->getNamespace()] != true ) {
			return true;
		}
	} elseif ( $title->getNamespace() != NS_ANSWER ) {
		return true;
	}

	$wgOut->addModules( 'ext.EditResearch' );

	$editPage->editFormTextBeforeContent .=
		'<div id="research-container">
		<h3>' . wfMsg( 'editresearch-wikipedia-title' ) . '</h3>
		<div id="research-inner">
			<div id="research-search">'
				. wfMsg( 'editresearch-search-wikipedia' ) .
				' <input type="text" id="search_input" />
				<input id="search_button" type="button" value="' . wfMsg( 'go' ) . '" onclick="research()" />
			</div>
			<div id="research_box"></div>
		</div>
	</div>';

	return true;
}