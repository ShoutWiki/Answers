<?php
/**
 * Answers skin for answers.wikia.com
 * $wgAnswersShowInlineRegister - if set to true, inline_register.js will be included
 * in every page load to allow users to register without going to Special:UserLogin
 *
 * @todo FIXME: rename classes, update CSS/JS/image paths, etc. (added on July 31 2012)
 *
 * @file
 * @ingroup Skins
 * @author Nick Sullivan <nick@wikia-inc.com>
 * @author Jack Phoenix <jack@countervandalism.net>
 * @date November 24, 2009
 * @version r15339
 * @note http://trac.wikia-code.com/changeset?new=13205@wikia%2Ftrunk%2Fskins%2FAnswers.php&old=12124@wikia%2Ftrunk%2Fskins%2FAnswers.php
 *		-> did not implement HomePageList calls
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * AJAX functions from extensions/wikia/AjaxFunctions.php
 * @see answers/js/main.js
 */
global $wgAjaxExportList;
$wgAjaxExportList[] = 'getSuggestedArticleURL';
$wgAjaxExportList[] = 'cxValidateUserName';

/**
 * @param $text String: text
 * @return Full URL to a suggested article
 */
function getSuggestedArticleURL( $text ) {
	$title = Title::newFromText( rawurldecode( $text ) );
	$result = '';
	if( is_object( $title ) && ( $title instanceof Title ) ) {
		$result = $title->getFullURL();
	}
	return $result;
}

/**
 * Validates user names.
 *
 * @param $userName Mixed: user name to check for validity
 * @return String: whether user name exists (EXISTS), is not valid (INVALID) or is valid (OK)
 */
function cxValidateUserName( $userName ) {
	$nt = Title::newFromText( $userName );
	if( is_null( $nt ) ) {
		# Illegal name
		return 'INVALID';
	}

	$userName = $nt->getText();

	$dbr = wfGetDB( DB_SLAVE );
	if( $userName == '' ) {
		return 'INVALID';
	}

	$row = $dbr->selectRow(
		'user',
		'user_name',
		array( 'user_name' => $userName ),
		__METHOD__
	);
	if( $row !== false || $dbr->numRows( $row ) ) {
		return 'EXISTS';
	}

	return 'OK';
}

/**
 * Inherit main code from Monaco, set the CSS and template filter.
 * @ingroup Skins
 */
if ( !class_exists( 'SkinMonaco' ) ) {
	require( '../../../skins/Monaco/Monaco.php' );
}

class SkinAnswersOld extends SkinMonaco {

	var $skinname = 'answersold', $stylename = 'answersold',
		$template = 'AnswersOldTemplate', $useHeadElement = false;//true;

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		global $wgHooks;
		$wgHooks['MakeGlobalVariablesScript'][] = array( $this, 'addAnswersVariables' );
	}

	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
	}

	// Quick hack thrown together on June 25, 2009
	// @see http://answers.wikia.com/wiki/Wikianswers
	function addAnswersVariables( $vars ) {
		global $wgContLang, $wgServer, $wgArticlePath, $wgEnableFacebookConnect;
		$vars['wgAskFormTitle'] = wfMsg( 'ask_a_question' ) . '...';
		$vars['wgAskFormCategory'] = wfMsg( 'in_category' );
		$vars['wgAnswerMsg'] = wfMsg( 'answer_title' );
		$vars['wgRenameMsg'] = wfMsg( 'movepagebtn' );# Core msg - on answers.wikia this has been customized to "Rephrase" instead of default "Move page"
		$vars['wgDeleteMsg'] = wfMsg( 'delete');
		$vars['wgSaveMsg'] = wfMsg( 'save' );
		$vars['wgCategorizeMsg'] = wfMsg( 'categorize' );
		$vars['wgCategorizeHelpMsg'] = wfMsg( 'categorize_help' );
		$vars['wgNextPageMsg'] = Xml::escapeJsVar( wfMsg( 'next_page' ) ); #"Next \x26raquo;";
		$vars['wgPrevPageMsg'] = Xml::escapeJsVar( wfMsg( 'prev_page' ) ); #"\x26laquo; Prev";
		$vars['wgMoreMsg'] = "\x26lt;more\x26gt;"; # ??? FIXME
		$vars['wgActionPanelTitleMsg'] = wfMsg( 'quick_action_panel' );
		$vars['wgIsQuestion'] = Answer::newFromTitle( $wgTitle )->isQuestion();
		$vars['wgIsAnswered'] = false;
		$vars['wgAnsweredCategory'] = wfMsg( 'answered_category' );
		$vars['wgUnAnsweredCategory'] = wfMsg( 'unanswered_category' );
		$vars['wgUnansweredRecentChangesURL'] = $wgServer . str_replace( '$1', 'Special:RecentChangesLinked/' . $wgContLang->getNsText( NS_CATEGORY ) . ':' . wfMsgForContent( 'unanswered_category' ), $wgArticlePath ); #"http://answers.wikia.com/wiki/Special:RecentChangesLinked/Category:un-answered questions";
		$vars['wgUnansweredRecentChangesText'] = wfMsg( 'see_all' );
		$vars['wgCategoryName'] = $wgContLang->getNsText( NS_CATEGORY );
		$vars['wgEnableFacebookConnect'] = ( ( $wgEnableFacebookConnect ) ? true : false );
	}

}

/**
 * @ingroup Skins
 */
class AnswersOldTemplate extends MonacoTemplate {
	var $skin;

	/**
	 * Template filter callback for Answers skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
		global $wgRequest, $wgUser, $wgStyleVersion, $wgTitle, $wgEnableFacebookConnect, $wgSitename;

		$this->skin = $skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );
		$answer_page = Answer::newFromTitle( $wgTitle );
		$is_question = $answer_page->isQuestion();
		if ( $is_question ) {
			$question_mark = '?';
		} else {
			$question_mark = '';
		}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<?php $this->text('xhtmldefaultnamespace') ?>" <?php
	foreach($this->data['xhtmlnamespaces'] as $tag => $ns) {
		?>xmlns:<?php echo "{$tag}=\"{$ns}\" ";
	} ?>xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
	<head>
		<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset="<?php $this->text('charset') ?>" />
		<?php $this->html('headlinks') ?>
			<link rel="stylesheet" type="text/css" href="<?php $this->text( 'stylepath' ) ?>/answers/css/monobook_modified.css?<?php echo $wgStyleVersion?>" />
			<link rel="stylesheet" type="text/css" href="<?php $this->text( 'stylepath' ) ?>/answers/css/reset_modified.css?<?php echo $wgStyleVersion?>" />
		<!-- Combo-handled YUI CSS files: -->
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/autocomplete/assets/skins/sam/autocomplete.css&2.7.0/build/container/assets/skins/sam/container.css">
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/container/assets/container.css">
		<!-- Combo-handled YUI JS files: -->
		<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/utilities/utilities.js&2.7.0/build/datasource/datasource-min.js&2.7.0/build/autocomplete/autocomplete-min.js&2.7.0/build/container/container-min.js&2.7.0/build/logger/logger-min.js"></script>
		<script type="text/javascript" src="<?php $this->text( 'stylepath' ) ?>/common/yui/3rdpart/tools.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script type="text/javascript" src="<?php $this->text( 'stylepath' ) ?>/answers/js/main.js?<?php echo $wgStyleVersion ?>"></script>
		<?php
		if( $wgEnableFacebookConnect ) {
		?>
		<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/cookie/cookie-min.js"></script>
		<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
		<?php } ?>

		<title><?php $this->text('pagetitle') ?></title>
		<?php $this->html('csslinks') ?>

		<?php echo Skin::makeGlobalVariablesScript( $this->data ); ?>

		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text( 'stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
		<!-- Head Scripts -->
<?php $this->html('headscripts') ?>
			<link rel="stylesheet" type="text/css" href="<?php $this->text( 'stylepath' ) ?>/answers/css/main.css?<?php echo $wgStyleVersion ?>" />
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" href="<?php $this->text( 'stylepath' ) ?>/answers/css/ie6.css?<?php echo $wgStyleVersion ?>" />
		<![endif]-->
<?php	if($this->data['jsvarurl']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
<?php	} ?>
<?php	if($this->data['pagecss']) { ?>
		<style type="text/css"><?php $this->html('pagecss') ?></style>
<?php	}
		if($this->data['usercss']) { ?>
		<style type="text/css"><?php $this->html('usercss') ?></style>
<?php	}
		if($this->data['userjs']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php	}
		if($this->data['userjsprev']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php	}
		if($this->data['trackbackhtml']) echo $this->data['trackbackhtml']; ?>
	</head>
<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>
 <?php if( $answer_page->isQuestion( false, false ) && $action == 'edit' ) { ?>editquestion<?php } ?>
 <?php if( $answer_page->isQuestion( false, false ) && $action == 'submit' ) { ?>editquestion<?php } ?>">

<!-- GetHTMLAfterBody -->
<?php wfRunHooks( 'GetHTMLAfterBody', array( $this ) ); ?>
<!-- GetHTMLAfterBody -->

	<!-- ##### Begin main content #### -->
	<div id="answers_header" class="reset">
		<a href="/" id="wikianswers_logo"><img src="<?php $this->text( 'stylepath' ) ?>/answers/images/wikianswers_logo.png" alt="<?php print $wgSitename; ?>" title="<?php print $wgSitename; ?>" /></a>

		<div class="yui-skin-sam" id="ask_wrapper">

		<div id="answers_ask">
			<form method="get" action="" onsubmit="return false" name="ask_form" id="ask_form">
				<input type="text" id="answers_ask_field" value="<?php echo htmlspecialchars( wfMsg( 'ask_a_question' ) ) ?>" class="header_field alt" /><span>?</span>
				<input type="text" id="answers_category_field" value="<?php echo htmlspecialchars( wfMsg( 'in_category' ) ) ?>" class="header_field alt" />
				<a href="javascript:void(0);" id="ask_button" class="huge_button huge_button_green"><div></div><?php echo wfMsg( 'ask_button' ) ?></a>
			</form>
		</div><!-- #answers_ask -->
		<div id="answers_suggest"></div>
		</div>

		<?php echo $this->execUserLinks(); ?>

	</div><!-- #answers_header -->

	<div id="answers_page">
		<div id="page_bar" class="reset color1 clearfix">
			<ul id="page_controls">
			<?php
			if( isset( $this->data['articlelinks']['left'] ) ) {
				foreach( $this->data['articlelinks']['left'] as $key => $val ) {
			?>
					<li id="control_<?php echo $key ?>" class="<?php echo $val['class'] ?>"><div>&nbsp;</div><a rel="nofollow" id="ca-<?php echo $key ?>" href="<?php echo htmlspecialchars( $val['href'] ) ?>" <?php echo $skin->tooltipAndAccesskey( 'ca-' . $key ) ?>><?php echo htmlspecialchars( ucfirst( $val['text'] ) ) ?></a></li>
			<?php
				}
			}
			?>
			</ul>
			<ul id="page_tabs">
			<?php
			$showright = true;
			if( defined( 'NS_BLOG_ARTICLE' ) && $wgTitle->getNamespace() == NS_BLOG_ARTICLE ) {
				$showright = false;
			}
			if( isset( $this->data['articlelinks']['right'] ) && $showright ) {
				foreach( $this->data['articlelinks']['right'] as $key => $val ) {
			?>
					<li class="<?php echo $val['class'] ?>"><a href="<?php echo htmlspecialchars($val['href']) ?>" id="ca-<?php echo $key ?>" <?php echo $skin->tooltipAndAccesskey( 'ca-' . $key ) ?> class="<?php echo $val['class'] ?>"><?php echo htmlspecialchars( ucfirst( $val['text'] ) ) ?></a></li>
			<?php
				}
			}
			?>
			</ul>
		</div><!-- #page_bar -->

		<div id="answers_article">

		<a name="top" id="top"></a>

		<?php if( $this->data['sitenotice'] ) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

		<?php
		if ( $answer_page->isQuestion( true ) ) {
			$author = $answer_page->getOriginalAuthor();

			$category_text = array();
			global $wgOut;
			$categories_array = $wgOut->getCategoryLinks();
			if( !empty( $categories_array['normal'] ) ){
				foreach( $categories_array['normal'] as $ctg ) {
					$category_text[] = strip_tags( $ctg );
				}
			}
			if( $category_text ) {
				$google_hints = '';
				foreach( $category_text as $ctg ){
					if(
						strtoupper( $ctg ) != strtoupper( wfMsgForContent( 'unanswered_category' ) ) &&
						strtoupper( $ctg ) != strtoupper( wfMsgForContent( 'answered_category' ) )
					)
					{
						$google_hints .= ( ( $google_hints ) ? ', ' : '' ) . $ctg;
					}
				}
				if( $google_hints == '' ) {
					$google_hints = str_replace( "'", "\'", $wgTitle->getText() );
				}
			}
		?>

		<div id="question">
			<div class="top"><span></span></div>
			<h1 id="firstHeading" class="firstHeading"><?php $this->data['displaytitle'] != '' ? $this->html('title') : $this->text('title') ?>
			<?php echo $question_mark ?>
			<?php if( !empty( $this->data['content_actions']['move'] ) ): ?>
				<a href="<?php echo $this->data['content_actions']['move']['href']?>" rel="nofollow"><?php echo wfMsg( 'rephrase' ) ?></a>
			<?php endif; ?>
			</h1>
			<!--<div class="categories">
			<?php
			/*
				foreach( $category_text as $ctg ) {
					$category_title = Title::makeTitle( NS_CATEGORY, $ctg );
					if( $categories ) {
						$categories .= ', ';
					}
					$categories .= '<a href="' . $category_title->escapeFullURL() . "\">{$ctg}</a>";
				}
				echo wfMsg( 'categories' ) . ': ' . $categories;
				*/
				?>
			</div>-->
			<?php
			if( $wgUser->isLoggedIn() ) {
				$watchlist_url = $wgTitle->escapeFullURL( 'action=watch' );
			} else {
				$watchlist_url = 'javascript:anonWatch();';
			}
			?>
			<div id="question_actions">
				<button class="button_small button_small_green" onclick="document.location='<?php echo $wgTitle->getEditURL() ?>';"><span><?php echo ( $answer_page->isArticleAnswered() ? wfMsg( 'improve_this_answer' ) : wfMsg( 'answer_this_question' ) ); ?></span></button>
				<?php
				global $wgEnableEditResearch;
				if( $wgEnableEditResearch ) {
				?>
					<button class="button_small button_small_blue" onclick="document.location='<?php echo $wgTitle->getEditURL() ?>';"><span><?php echo wfMsg( 'research_this' ) ?></span></button>
				<?php
				}
				?>
				<button class="button_small button_small_blue" onclick="document.location='<?php echo $watchlist_url ?>';"><span><?php echo ( $answer_page->isArticleAnswered() ? wfMsg( 'notify_improved' ) : wfMsg( 'notify_answered' ) ); ?></span></button>
			</div>
			<div class="bottom"><span></span></div>
		</div>
		<div id="attribution" class="clearfix">
			<div>
			<?php
			if( ip2long( $author['user_name'] ) ) {
				?><span><?php echo wfMsg( 'question_asked_by_a_wiki_user' ) ?></span>
				<?php echo $author['avatar'];
			} else {
				$url = $author['title']->escapeFullURL();
				?><span><?php echo wfMsg( 'question_asked_by' ) ?> <a href="<?php echo $url ?>"><?php echo $author['user_name'] ?></a></span>
				<a href="<?php echo $url ?>"><?php echo $author['avatar'] ?></a>
			<?php
			}
			?>
			</div>
			<div id="question_tail"></div>
		</div>
		<?php
		} else {
		?>

		<h1 id="firstHeading" class="firstHeading"><?php $this->data['displaytitle'] != '' ? $this->html('title') : $this->text('title') ?></h1>
		<?php
		}

		// Magic Answer
		if( !empty( $_GET['state'] ) && $_GET['state'] == 'asked' ) {
			$this->displayMagicAnswer();
		}
		?>


		<?php
		global $wgTitle;
		if ( $is_question && $answer_page->isArticleAnswered() ) {
			if( !( $wgRequest->getVal( 'diff' ) ) ) {
				echo '<div class="sectionedit">[<a href="' . $this->data['content_actions']['edit']['href'] . '">' .
					wfMsg( 'editsection' ) . '</a>]</div>';
				echo '<h3 class="answer_title">' . wfMsg( 'answer_title' ) . '</h3>';
			}

			$bodyContentClass = ' class="question"';
		} elseif( $wgTitle->getNamespace() == NS_CATEGORY ) {
			$bodyContentClass = ' class="category"';
		} else {
			$bodyContentClass = '';
		}
		?>

		<div id="bodyContent"<?php echo $bodyContentClass ?>>
			<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
			<div id="contentSub"><?php $this->html('subtitle') ?></div>
			<?php if( $this->data['undelete'] ) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
			<?php if( $this->data['newtalk'] ) { ?><div class="usermessage noprint"><?php $this->html('newtalk') ?></div><?php } ?>
			<?php if( $this->data['showjumplinks'] ) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#search_input"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
			<?php
			// AdSense for search
			global $wgAFSEnabled;
			if( $wgAFSEnabled && $wgTitle->getLocalURL() == $this->data['searchaction'] && !$wgUser->isLoggedIn() ) {
				//renderAdsenseForSearch( 'w2n8', '7000000004' ); // @todo FIXME: wikia's codes
			}
			?>
			<!-- start content -->
			<?php $this->html( 'bodytext' ) ?>
			<!-- end content -->
			<?php if( $this->data['dataAfterContent'] ) { $this->html('dataAfterContent'); } ?>

			<div class="visualClear"></div>
		</div><!-- #bodyContent -->

		<?php
		if( $is_question && !$answer_page->isArticleAnswered() ) {
			if( !( $wgRequest->getVal( 'diff' ) ) && $wgUser->isAnon() ) {
				$ads = '<div id="ads-unaswered-bottom">
				<script type="text/javascript">
					google_ad_client = "pub-4086838842346968";
					google_ad_channel = ( ( wgIsAnswered ) ? "7000000004" : "7000000003" );
					google_ad_width	= "300";
					google_ad_height = "250";
					google_ad_format = google_ad_width + "x" + google_ad_height + "_as";
					google_ad_type = "text";
					google_color_link = "002BB8";
					google_color_border = "FFFFFF";
					google_hints = "' . $google_hints . '";
				</script>
				<script language="JavaScript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
				</div>';
				echo $ads;
			}
		} elseif ( $answer_page->isQuestion( true /* exists? */) && $answer_page->isArticleAnswered() ) {
			// render attribution section
			echo $this->renderAttributionBox( $answer_page );
			if ( $wgUser->isAnon() ) {
				$ads = '<script type="text/javascript">
					google_ad_client = "pub-4086838842346968";
					google_ad_channel = ( ( wgIsAnswered ) ? "7000000004" : "7000000003" );
					google_ad_width = "468";
					google_ad_height = "60";
					google_ad_format = google_ad_width + "x" + google_ad_height + "_as";
					google_ad_type = "text";
					google_color_link = "002BB8";
					google_color_border = "FFFFFF";
					google_hints = "' . $google_hints . '";
				</script>
				<script language="JavaScript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>';
				echo $ads;
			}
		}

		global $wgTitle, $wgAnswersShowInlineRegister;
		if( $wgAnswersShowInlineRegister && $wgUser->isAnon() && !$answer_page->isArticleAnswered() && $_GET['state'] == 'asked' ) {
			$submit_title = SpecialPage::getTitleFor( 'Userlogin' );
			$submit_url = $submit_title->escapeFullURL( 'type=signup&action=submitlogin' );

			global $wgOut, $wgCaptchaTriggers;
				if( $wgCaptchaTriggers['createaccount'] ) {
					$f = new FancyCaptcha();
					$captcha = ( '<div class="captcha">' .
						wfMsg( 'createaccount-captcha' ) .
						$f->getForm() . "</div>\n" );
				}
			?>
			<script type="text/javascript" src="<?php $this->text( 'stylepath' ) ?>/answers/js/inline_register.js?<?php echo $wgStyleVersion ?>"></script>
			<div class="inline_form reset">
				<h1><?php echo wfMsg( 'inline-register-title' ) ?></h1>
				<div class="inline_form_inside">
					<form name="register" method="post" id="register" action="<?php echo $submit_url ?>">
						<?php echo $captcha ?>
						<div style="padding: 10px 0 0 15px;"><b><?php echo wfMsg( 'createaccount' ) ?></b> | <a href="<?php echo htmlspecialchars( Skin::makeSpecialUrl( 'Userlogin', 'returnto=' . $wgTitle->getPrefixedURL() ) )?>"><?php echo wfMsg( 'log_in' ) ?></a></div>
						<table>
						<tr>
							<td><?php echo wfMsg( 'yourname' ) ?></td>
							<td><input type="text" value="" name="wpName" id="wpName2" /> <span id="username_check"></span></td>
						</tr>
						<tr>
							<td><?php echo wfMsg( 'youremail' ) ?></td>
							<td><input type="text" value="" name="wpEmail" id="wpEmail" /></td>
						</tr>
						<tr>
							<td><?php echo wfMsg( 'yourpassword' ) ?></td>
							<td><input type="password" value="" name="wpPassword" id="wpPassword2" /></td>
						</tr>
						<tr>
							<td><?php echo wfMsg( 'yourpasswordagain' ) ?></td>
							<td><input type="password" value="" name="wpRetype" id="wpRetype" /></td>
						</tr>
						</table>
						<div style="padding: 0 0 10px 15px;"><?php $this->msgWiki( 'prefs-help-terms' ); ?></div>
						<input type="hidden" name="wpRemember" value="1" id="wpRemember" />
						<div class="toolbar">
							<input type="submit" name="wpCreateaccount" id="wpCreateaccount" value="<?php echo wfMsg( 'createaccount' ) ?>" />
							<a href="#" class="skip_link"><?php echo wfMsg( 'skip_this' ) ?></a>
						</div>
					</form>
				</div>
			</div>
			<?php
		}

		if( $wgUser->isLoggedIn() && !$answer_page->isArticleAnswered() && $wgRequest->getVal( 'state' ) == 'registered' ) {
		?>
			<div class="inline_form reset">
				<h1><?php /* @todo FIXME: wfMsg() is magical, it can take args! */echo wfMsg( 'inline-welcome' ) ?>, <?php echo $wgUser->getName() ?></h1>
				<div class="inline_form_inside">
					<div style="padding: 10px;">
					<?php echo wfMsg( 'ask_thanks' ) ?>
					</div>
				</div>
			</div>

		<?php
		}
		if ( !$wgRequest->getVal( 'diff' ) && $is_question ) {
			if( $wgUser->isLoggedIn() ){
				$watchlist_url = $wgTitle->escapeFullURL( 'action=watch' );
			} else {
				$watchlist_url = 'javascript:anonWatch();';
			}
		?>
		<!--
		<table id="bottom_ads">
		<tr>
			<td id="google_ad_1" class="google_ad"></td>
			<td id="google_ad_2" class="google_ad"></td>
		</tr>
		</table>
		-->
		<?php
		/*
		<div id="huge_buttons" class="clearfix">
			<?php if ( $answer_page->isArticleAnswered() ) { ?>
			<a href="<?php echo $wgTitle->getEditURL() ?>" class="huge_button edit"><div></div><?php echo wfMsg( 'improve_this_answer' ) ?></a>
			<a href="<?php echo $watchlist_url ?>" class="huge_button watchlist"><div></div><?php echo wfMsg( 'notify_improved' ) ?></a>
			<?php } else { ?>
			<a href="<?php echo $wgTitle->getEditURL() ?>" class="huge_button edit"><div></div><?php echo wfMsg( 'answer_this_question' ) ?></a>
			<a href="<?php echo $watchlist_url ?>" class="huge_button watchlist"><div></div><?php echo wfMsg( 'notify_answered' ) ?></a>
			<?php } ?>
		</div>
		*/

		$tinyURL = Http::get( "http://tinyurl.com/api-create.php?url={$wgTitle->getFullURL()}" );
		$twitter_question = urlencode( substr( $wgTitle->getText(), 0, 99 ) );
		$twitter_url = 'http://twitter.com/home?status=' . $twitter_question . '? ' . $tinyURL . ' ' . urlencode( '#' . wfMsg( 'twitter_hashtag' ) );
		$move_title = SpecialPage::getTitleFor( 'Movepage', $wgTitle );
		$move_url = $move_title->getLocalURL();

		if( !$answer_page->isArticleAnswered() ) {
		?>
			<h3 class="answer_title"><?php echo wfMsg( 'answer_title' ) ?></h3>
			<div><?php echo wfMsg( 'question_not_answered' ) ?></div>

			<div id="unanswered-links">
			<div><?php echo wfMsg( 'you_can' ) ?></div>
			<ul>
			<li><?php echo wfMsg( 'answer_this', $wgTitle->getEditURL() ) ?></li>
			<li><?php echo wfMsg( 'research_this_on_wikipedia', $wgTitle->getEditURL() ) ?></li>
			<li><?php echo wfMsg( 'ask_friends_on_twitter', $twitter_url ) ?></li>
			<li><?php echo wfMsg( 'receive_email', $watchlist_url ) ?></li>
			<li><?php echo wfMsg( 'reword_this', $move_url ) ?></li>
			</ul>
			</div>
		<?php
// Commented out all this shit, per
// http://trac.wikia-code.com/changeset?new=14996@wikia%2Ftrunk%2Fskins%2FAnswers.php&old=14144@wikia%2Ftrunk%2Fskins%2FAnswers.php
#		} else {
		?>

<!--	<div id="social_networks">
		<span id="ask_friends_label"><?php echo wfMsg( 'ask_friends' ) ?></span>-->
			<?php
#			if( $wgEnableFacebookConnect == true ) {
			?>
<!--		<script>
			var wgFacebookAskMsg = "<?php echo wfMsg( 'facebook_ask' ) ?>";
			var wgFacebookSignedInMsg = "<?php echo wfMsg( 'facebook_signed_in' ) ?>";
			var wgFacebookLogoutMsg = "<?php echo wfMsg( 'logout' ) ?>";
			</script>
			<div id="facebook-connect-login" style="display:none">
				<?php/*<fb:login-button size="small" background="light" length="short" onlogin="facebook_login_handler()"></fb:login-button> <a href="javascript:FB.Connect.requireSession()">Facebook</a>*/?>
				<fb:login-button size="medium" background="white" length="long" onlogin="facebook_login_handler()"></fb:login-button>
			</div>
			<div id="facebook-connect-ask" style="display:none">
			</div>-->

			<?php
#			}
			?>

		<!--<div id="twitter-post">
			<a href="<?php echo $twitter_url ?>" onclick="window.open('<?php echo $twitter_url ?>', 'twitter'); return false;">
				<img src="<?php echo $this->text( 'stylepath' ); ?>/skins/answers/images/twitter_icon.png" alt="" />
			</a>
			<a href="<?php echo $twitter_url ?>" onclick="window.open('<?php echo $twitter_url ?>', 'twitter'); return false;"><?php echo wfMsg( 'twitter_ask' ) ?></a>
		</div>
		</div>--><!-- #social_networks -->
		<?php
#		if( $wgEnableFacebookConnect ) {
		?>
		<!--
			<div><a href='javascript:void(0);' onclick='jQuery("#facebook-send-request").toggle();'><?php echo wfMsg( 'facebook_send_request' ) ?></a></div>
			<div id="facebook-send-request" style="display:none;">
			<fb:serverfbml>
			<script type="text/fbml">
			<fb:fbml>
			<fb:request-form invite="false" type="Wikianswers" action="<?php echo $wgTitle->getFullURL() ?>" content="<?php echo wfMsg( 'facebook_send_request_content', htmlentities( '<a href="' . $wgTitle->getFullURL() . '">' . $wgTitle->getText() . '</a>' ) ) ?>" style="height:300px">
			<fb:multi-friend-input border_color="#8496ba"></fb:multi-friend-input>
			<fb:request-form-submit />
			</fb:request-form>
			</fb:fbml>
			</script>
			</fb:serverfbml>
			</div>
			<script type="text/javascript">FB.init(wgFacebookAnswersAppID, wgServer + wgScriptPath + '/extensions/FacebookConnect/xd_receiver.htm');</script>
			-->
			<!--<div id="facebook-connect"></div>-->
			<?php
/*				if( $_GET['state'] == 'asked' && facebook_client()->get_loggedin_user() ){
					echo '<script>facebook_publish_feed_story()</script>';
				}
		}
		}*/
		}
		?>

		<?php if( $this->data['catlinks'] ) { $this->html('catlinks'); } ?>

		<!-- XIAN: Pull content that is now in "AnswersAfterArticle" hook -->

		<?php if ( $is_question ) { ?>
		<div id="related_questions" class="reset">
			<h2><?php echo wfMsg( 'related_questions' ) ?></h2>
			<ul id="related_answered_questions">
				<?php /* HomePageList::related_answered_questions(); */ ?>
			</ul>
		</div>
		<?php } ?>
		</div><!-- #answers_article -->
	</div><!-- #answers_page -->

	<?php
	if( isset( $this->data['userlinks']['more'] ) ) {
	?>
		<div id="header_menu_user" class="header_menu reset">
		<ul>
	<?php
		foreach( $this->data['userlinks']['more'] as $itemKey => $itemVal ) {
		if( $itemKey == 'widgets' ) {
			continue;
		}
	?>
			<li><a rel="nofollow" href="<?php echo htmlspecialchars( $itemVal['href'] ) ?>" class="yuimenuitemlabel"<?php echo $skin->tooltipAndAccesskey( 'pt-' . $itemKey ) ?>><?php echo htmlspecialchars( $itemVal['text'] ) ?></a></li>
	<?php
		}
	?>
		</ul>
	</div>
	<?php
	}

	$wikifooterlinks = $this->data['data']['wikifooterlinks'];
	if( count( $wikifooterlinks ) > 0 ) {
		echo '<div id="footer">';

		if( $wgEnableFacebookConnect ) {
			echo '<div id="facebook-connect-logout" style="display:none">
				<div id="facebook-user-placeholder"></div>
			</div>';
		}

		$wikifooterlinksA = array();
		foreach( $wikifooterlinks as $key => $val ) {
			// Very primitive way to actually have copyright WF variable, not MediaWiki:msg constant.
			// This is only shown when there is copyright data available. It is not shown on special pages for example.
			if ( $val['text'] == 'GFDL' ) {
				if( !empty( $this->data['copyright'] ) ) {
					$wikifooterlinksA[] = $this->data['copyright'];
				}
			} else {
				$wikifooterlinksA[] = '<a rel="nofollow" href="' .
					htmlspecialchars( $val['href'] ) . '">' . $val['text'] .
					'</a>';
			}
		}
		$wikifooterlinksA_2 = array_splice( $wikifooterlinksA, ceil( count( $wikifooterlinksA ) / 2 ) );
		echo implode( ' | ', $wikifooterlinksA );
		echo '<br />';
		echo implode( ' | ', $wikifooterlinksA_2 );
		echo '</div>';
	}
	?>


		<div id="answers_sidebar" class="reset">
		<?php
		/*
		( $wgUser->isLoggedIn() ) ? $toolboxClass = '' : $toolboxClass = ' class="anon"';
		*/
		?>
		<div id="toolbox">
			<div id="toolbox_stroke">
			<?php
			/* SAME TOOLBOX FOR USERS AND ANONS
			if( $wgUser->isLoggedIn() ) {
			*/
			?>
				<div id="toolbox_inside">
					<h6><?php echo wfMsg( 'answers_toolbox' ) ?></h6>

					<table>
					<tr>
						<td>
						<?php
						for( $i = 0; $i < ceil( count( $this->data['data']['toolboxlinks'] ) / 2 ); $i++ ) {
							echo '<a href="' . $this->data['data']['toolboxlinks'][$i]['href'] . '">' .
								$this->data['data']['toolboxlinks'][$i]['text'] . '</a><br />';
						}
						?>
						</td>
						<td>
						<?php
						for( $i; $i < count( $this->data['data']['toolboxlinks'] ); $i++ ) {
							echo '<a href="' . $this->data['data']['toolboxlinks'][$i]['href'] . '">' .
								$this->data['data']['toolboxlinks'][$i]['text'] . '</a><br />';
						}
						?>
						</td>
					</tr>
					</table>
				</div><!-- #toolbox_inside -->
				<div id="toolbox_search">
					<?php echo $this->searchBox(); ?>
				</div>
			<?php
			/*
			} else {
			?>
				<div id="toolbox_inside">
					<img src="/skins/answers/images/mr_wales.jpg" class="portrait" />
					<?php echo wfMsgExt( 'toolbox_anon_message', 'parse' )?>
				</div>
			<?php
			}
			*/
			?>
			</div><!-- #toolbox_stroke -->
		</div><!-- #toolbox -->

		<div class="widget">
			<h2><?php echo wfMsg( 'recent_unanswered_questions' ) ?></h2>
			<ul id="recent_unanswered_questions">
			</ul>
			<?php
			if( $is_question ) {
				echo '<li><div id="google_ad_1" class="google_ad"></div></li>';
			}
			?>
		</div>

		<div class="widget">
			<h2><?php echo wfMsg( 'popular_categories' ) ?></h2>
			<ul id="popular_categories">
				<?php
				$popular_categories = array();
				$lines = $this->getMessageAsArray( 'sidebar-popular-categories' );
				if( is_array( $lines ) ){
					foreach( $lines as $line ) {
						$item = $this->parseItem( trim( $line, ' *' ) );
						$popular_categories[] = $item;
					}
				}
				if( is_array( $popular_categories ) ) {
					foreach( $popular_categories as $popular_category ) {
						echo '<li><a href="' . $popular_category['href'] . '">' . $popular_category['text'] . '</a></li>';
					}
				}
				if ( $is_question ) {
					echo '<li><div id="google_ad_2" class="google_ad"></div></li>';
				}
				?>
			</ul>
		</div>

	</div><!-- #answers_sidebar -->

	<div id="footer">
	</div><!-- #footer -->
</div>
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>

-->
<?php endif; ?>
<script>
google_ad_client = 'pub-4086838842346968'; // substitute your client_id (pub-#)
google_ad_channel = ( ( wgIsAnswered ) ? '7000000004' : '7000000003' );
google_ad_output = 'js';
google_max_num_ads = '10';
google_ad_type = 'text';
google_feedback = 'on';
<?php
echo 'google_hints = "' . $google_hints . '";';
?>
</script>
<script language="JavaScript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
<div id="positioned_elements" class="reset"></div>

</body></html>
<?php
	wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/
	function searchBox() {
?>
			<form action="<?php $this->text( 'searchaction' ) ?>" id="searchform">
				<input id="search_input" name="search" type="text"<?php echo $this->skin->tooltipAndAccesskey( 'search' );
					if( isset( $this->data['search'] ) ) { ?> value="<?php $this->text( 'search' ) ?>"<?php } ?> />
				<input type="submit" name="go" class="search_button" id="search_go_button" value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-go' ); ?> />
				<input type="submit" name="fulltext" class="search_button" id="search_button" value="<?php $this->msg('searchbutton') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-fulltext' ); ?> />
			</form>
<?php
	}

	/*************************************************************************************************/
	function toolbox() {
?>
	<div class="portlet" id="p-tb">
		<h5><?php $this->msg('toolbox') ?></h5>
		<div class="pBody">
			<ul>
<?php
		if( $this->data['notspecialpage'] ) { ?>
				<li id="t-whatlinkshere"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
<?php
			if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
				<li id="t-recentchangeslinked"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li>
<?php 		}
		}
		if( isset( $this->data['nav_urls']['trackbacklink'] ) ) { ?>
			<li id="t-trackbacklink"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
<?php 	}
		if( $this->data['feeds'] ) { ?>
			<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
					?><span id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>"><a href="<?php
					echo htmlspecialchars($feed['href']) ?>"<?php echo $this->skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
					<?php } ?></li><?php
		}

		foreach( array( 'contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages' ) as $special ) {

			if( $this->data['nav_urls'][$special] ) {
				?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
<?php		}
		}

		if( !empty( $this->data['nav_urls']['print']['href'] ) ) { ?>
				<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
		}

		if( !empty( $this->data['nav_urls']['permalink']['href'] ) ) { ?>
				<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
		} elseif( $this->data['nav_urls']['permalink']['href'] === '' ) { ?>
				<li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
		}

		wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
?>
			</ul>
		</div>
	</div>
<?php
	}

	/*************************************************************************************************/
	function languageBox() {
		if( $this->data['language_urls'] ) {
?>
	<div id="p-lang" class="portlet">
		<h5><?php $this->msg( 'otherlanguages' ) ?></h5>
		<div class="pBody">
			<ul>
<?php		foreach( $this->data['language_urls'] as $langlink ) {
			// Add title tag only if differ from shown text
			$titleTag = $langlink['title'] == $langlink['text']
				? ''
				: 'title="' . htmlspecialchars( $langlink['title'] ) . '"';
			?>
				<li class="<?php echo htmlspecialchars( $langlink['class'] ) ?>"><?php
				?><a href="<?php echo htmlspecialchars( $langlink['href'] ) ?>"
				<? echo $titleTag ?> > <?php echo $langlink['text'] ?></a></li>
<?php		} ?>
			</ul>
		</div>
	</div>
<?php
		}
	}

	/*************************************************************************************************/
	function customBox( $bar, $cont ) {
?>
	<div class="generated-sidebar portlet" id="<?php echo Sanitizer::escapeId( "p-$bar" ) ?>"<?php echo $this->skin->tooltip( 'p-' . $bar ) ?>>
		<h5><?php $out = wfMsg( $bar ); if( wfEmptyMsg( $bar, $out ) ) echo $bar; else echo $out; ?></h5>
		<div class="pBody">
<?php   if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach( $cont as $key => $val ) { ?>
				<li id="<?php echo Sanitizer::escapeId( $val['id'] ) ?>"<?php
					if ( $val['active'] ) { ?> class="active" <?php }
				?>><a href="<?php echo htmlspecialchars( $val['href'] ) ?>"<?php echo $this->skin->tooltipAndAccesskey( $val['id'] ) ?>><?php echo htmlspecialchars( $val['text'] ) ?></a></li>
<?php			} ?>
			</ul>
<?php   } else {
			# allow raw HTML block to be defined by extensions
			print $cont;
		}
?>
		</div>
	</div>
<?php
	}

	public function execUserLinks() {
		global $wgUser;
		$skin = $wgUser->getSkin();
		if( $wgUser->isLoggedIn() ) {
			?>
			<ul id="user_data">
				<li id="header_username"><a href="<?php echo htmlspecialchars( $this->data['personal_urls']['userpage']['href'] ) ?>"<?php echo $skin->tooltipAndAccesskey( 'pt-userpage' ) ?>><?php echo htmlspecialchars( $wgUser->getName() ) ?></a></li>
				<li><a href="<?php echo htmlspecialchars( $this->data['personal_urls']['mytalk']['href'] ) ?>"<?php echo $skin->tooltipAndAccesskey( 'pt-mytalk' ) ?>><?php echo htmlspecialchars( $this->data['personal_urls']['mytalk']['text'] ) ?></a></li>
				<li><a href="<?php echo htmlspecialchars( $this->data['personal_urls']['watchlist']['href'] ) ?>"<?php echo $skin->tooltipAndAccesskey( 'pt-watchlist' ) ?>><?php echo htmlspecialchars( wfMsg( 'prefs-watchlist' ) ) ?></a></li>
				<li>
					<dl id="header_button_user" class="header_menu_button">
						<dt><?php echo trim( wfMsg( 'moredotdotdot' ), ' .' ) ?></dt>
						<dd>&nbsp;</dd>
					</dl>
				</li>
				<li><a rel="nofollow" href="<?php echo htmlspecialchars( $this->data['personal_urls']['logout']['href'] ) ?>" <?php echo $skin->tooltipAndAccesskey( 'pt-logout' ) ?>><?php echo htmlspecialchars( $this->data['personal_urls']['logout']['text'] ) ?></a></li>
			</ul>
		<?php
		} else { // not logged in
			global $wgTitle;
		?>
			<ul id="user_data" class="anon">
				<li id="userLogin">
					<a rel="nofollow" class="bigButton" id="login" href="<?php echo htmlspecialchars( Skin::makeSpecialUrl( 'Userlogin', 'returnto=' . $wgTitle->getPrefixedURL() ) ) ?>">
						<big><?php echo htmlspecialchars( wfMsg( 'login' ) ) ?></big>
						<small>&nbsp;</small>
					</a>
				</li>
				<li>
					<a rel="nofollow" class="bigButton" id="register" href="<?php echo htmlspecialchars( Skin::makeSpecialUrl( 'Userlogin', 'type=signup' ) ) ?>">
						<big><?php echo htmlspecialchars( wfMsg( 'nologinlink' ) ) ?></big>
						<small>&nbsp;</small>
					</a>
				</li>
			</ul>
<?php
		}
	}

	function displayMagicAnswer() {
		global $wgTitle;
		?>
		<div id="magicAnswer" style="display: none"><!-- display is shown in web service callback function -->
			<div id="magicAnswerLeft"><div id="magicAnswerRight"><div id="magicAnswerCurtainLeft"></div><div id="magicAnswerCurtainRight"></div><div id="magicAnswerHat"></div>
			<img id="magicAnswerLogo" src="<?php $this->text( 'stylepath' ) ?>/answers/images/magic_answer.png" />
			<form action="<?php echo $wgTitle->getLocalURL() ?>" method="get" id="magicAnswerForm"><!-- Must be GET or the edit form does preview -->
			<?php /* Note there is a hook called displayMagicAnswer in Answers.php on the Edit form that looks for "magic Answer" in theurl */ ?>
			<input type="hidden" name="action" value="edit" />
			<input type="hidden" id="magicAnswerField" name="magicAnswer" value=""/><!-- Filled in with JS -->
			<h6><?php echo wfMsg( 'magic_answer_headline' ) ?></h6>
			<div id="magicAnswerBox"></div>
			<div id="magicAnswerButtons" class="clearfix">
				<button id="magicAnswerYes" class="button_small button_small_green"><span><?php echo wfMsg( 'magic_answer_yes' ) ?></span></button>
				<button id="magicAnswerNo" class="button_small button_small_blue"><span><?php echo wfMsg( 'magic_answer_no' ) ?></span></button>
			</div>
			</form>
			<div id="magicAnswerStage">
				<a href="http://answers.yahoo.com" rel="nofollow"><?php echo wfMsg( 'magic_answer_credit' ) ?></a>
			</div>
			</div></div><!-- right, left -->
		</div>
		<script type="text/javascript">
		jQuery( '#magicAnswerNo' ).bind( 'click', function( e ) {
			jQuery( '#magicAnswer' ).animate( {opacity: '0'}, function() {
				jQuery( this ).slideUp()
			});
			return false;
		});
		jQuery( '#magicAnswerYes' ).bind( 'click', function( e ) {
			jQuery( '#magicAnswerForm' ).submit();
			return false;
		});
		MagicAnswer.getAnswer( "<?php echo addslashes( $this->data['title'] ) ?>", 'magicAnswerCallback' );
		function magicAnswerCallback( result ) {
			try {
				jQuery( '#magicAnswerBox' ).html( result.all.questions[0]['ChosenAnswer'] );
				jQuery( '#magicAnswerField' ).val( result.all.questions[0]['Subject'] );
				jQuery( '#magicAnswer' ).show();
			} catch( e ) {
				if( typeof window.console != 'undefined' ) {
					console.log( e );
				}
			}
		}
		</script>
		<?php
	}

	// Fucking ugly hack -- TODO FIXME: delete
	public static function setupI18n() {}

	public function renderAttributionBox( $answerPage ) {
		$contributors = $answerPage->getContributors();
		if( count( $contributors ) == 0 ) {
			return '';
		}

		// heading
		$ret = Xml::element( 'h3', array( 'class' => 'answer_title answered_title' ), wfMsg( 'answered_by' ) );

		// use <ul> as a list wrapper
		$ret .= Xml::openElement( 'ul', array( 'id' => 'contributors', 'class' => 'reset clearfix' ) );

		foreach( $contributors as $contributor ) {
			$ret .= Xml::openElement( 'li' );

			// get avatar
			$avatarImg = Answer::getUserAvatar( $contributor['user_id'] );
			$ret .= $avatarImg;

			// render user info
			$ret .= Xml::openElement( 'div', array( 'class' => 'userInfo' ) );

			if( $contributor['user_name'] == 'helper' ) {
				// anonymous users
				$ret .= Xml::element( 'span', array( 'class' => 'userPageLink' ), wfMsg( 'unregistered' ) );
				$ret .= Xml::element( 'span', array( 'class' => 'anonEditPoints' ), wfMsgExt( 'anonymous_edit_points', 'parsemag', array( $contributor['edits'] ) ) );
			} else {
				// link to user page
				$userPage = Title::newFromText( $contributor['user_name'], NS_USER );
				$userPageLink = !empty( $userPage ) ? $userPage->getLocalURL() : '';
				$ret .= Xml::element( 'a', array( 'href' => $userPageLink, 'class' => 'userPageLink' ), $contributor['user_name'] );

				// user points
				$ret .= Xml::openElement( 'div', array( 'class' => 'userEditPoints' ) );
				$ret .= Xml::element( 'span', array( 'id' => "contributors-user-points-{$contributor['user_id']}", 'class' => 'userPoints', 'timestamp' => wfTimestampNow() ), $contributor['edits'] );
				$ret .= ' '; // space for graceful degradation
				$ret .= wfMsgExt( 'edit_points', 'parsemag', array( $contributor['edits'] ) );
				$ret .= Xml::closeElement( 'div' ); // END .userEditPoints
			}

            $ret .= Xml::closeElement( 'div' ); // END .userInfo

           $ret .= Xml::closeElement( 'li' );
        }

		$ret .= Xml::closeElement( 'ul' ); // END #contributors

		return $ret;
	}

} // end of class
