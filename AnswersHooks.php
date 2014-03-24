<?php
/**
 * @file
 * @ingroup Extensions
 */
class AnswersHooks {

	/**
	 * Register the canonical names for the namespace and talkspace.
	 *
	 * @param $list Array: array of namespace numbers and their
	 *                     corresponding canonical names
	 * @return Boolean: true
	 */
	public static function createCanonicalNamespaces( &$list ) {
		$list[NS_ANSWER] = 'Answer';
		$list[NS_ANSWER_TALK] = 'Answer_talk';
		return true;
	}

	/**
	 * Injects ads into category pages.
	 * Hooked into the CategoryPageView hook.
	 *
	 * @param $cat
	 * @return Boolean: false
	 */
	public static function injectAdsToCategoryPages( &$cat ) {
		global $wgOut, $wgUser;

		//if ( $wgUser->isAnon() ) {
		//	$wgOut->addHTML( AdEngine::getInstance()->getPlaceHolderDiv('ANSWERSCAT_LEADERBOARD_A') );
		//}

		$article = new Article( $cat->mTitle );
		$article->view();

		if ( $cat->mTitle->getNamespace() == NS_CATEGORY ) {
			global $wgRequest;
			$from = $wgRequest->getVal( 'from' );
			$until = $wgRequest->getVal( 'until' );
			$viewer = new CategoryWithAds( $cat->mTitle, $from, $until );
			$wgOut->addHTML( $viewer->getHTML() );
		}

		return false;
	}

	/**
	 * When a page is added to a category view (for instance the list of
	 * Answered Questions on the Category page), a hook attached to this
	 * function is run which gives it a chance to modify the category view.
	 * For now, it wraps the link in a span with an specific class based on
	 * whether it is answered, unanswered, or a redirect.
	 *
	 * Since this function returns false, it prevents the default behavior from
	 * adding this item to the "pages" section of the category page.
	*/
	public static function addCategoryPage( &$catView, &$title, &$row ) {
		global $wgContLang;

		if ( empty( $catView->answers ) ) {
			$catView->answers = array();
			$catView->answers_start_char = array();
		}

		// For more detailed data about answers.
		if ( empty( $catView->answerArticles ) ) {
			$catView->answerArticles = array();
		}

		$answered_category = Title::makeTitle(
			NS_CATEGORY,
			ucfirst( Answer::getSpecialCategory( 'answered' ) )
		)->getPrefixedDBkey();
		$unanswered_category = Title::makeTitle(
			NS_CATEGORY,
			ucfirst( Answer::getSpecialCategory( 'unanswered' ) )
		)->getPrefixedDBkey();

		$cats = $title->getParentCategories();

		// Apply a different class depending on whether it is answered or not
		if ( isset( $cats[$answered_category] ) ) {
			$class = 'answered_questions';
		} elseif ( isset( $cats[$unanswered_category] ) ) {
			$class = 'unanswered_questions';
		} elseif ( $row->page_is_redirect ) {
			$class = 'redirect-in-category';
		} else {
			// Assume answered for now until David's isAnsweredQuestion is reworked
			$class = 'answered_questions';
		}
		$catView->answers[$class][] = "<span class=\"$class\">" .
			Linker::linkKnown( $title, $title->getPrefixedText() . '?' ) .
			'</span>';

		if ( !isset( $catView->answerArticles[$class] ) ) {
			$catView->answerArticles[$class] = array();
		}

		/*
		list( $namespace, $title ) = explode( ':', $row->cl_sortkey, 2 );
		$catView->answers_start_char[] = $wgContLang->convert( $wgContLang->firstChar( $title ) );
		*/

		// Note that return false here will prevent it from being displayed as a "normal" category
		return false;
	}

	/**
	 * This function will be called by a hook so that it can change the
	 * rendering of the CategoryPage.
	 *
	 * @param $catView CategoryView
	 * @param $r String: HTML
	 * @return Boolean: true
	 */
	public static function categoryOtherSection( &$catView, &$r ) {
		global $wgUser;

		if ( empty( $catView->answers ) ) {
			return true;
		}

		$ti = htmlspecialchars( $catView->title->getText() );
		$cat = $catView->getCat();

		//if ( $wgUser->isAnon() && $cat->getSubcatCount() > 0 && ( !empty( $catView->answers['answered_questions'] ) || !empty( $catView->answers['unanswered_questions'] ) ) ) {
		//	$r .= AdEngine::getInstance()->getPlaceHolderDiv( 'ANSWERSCAT_LEADERBOARD_U' );
		//}

		$r .= '<table style="width: 100%"><tr>';

		if ( !empty( $catView->answers['answered_questions'] ) ) {
			$r .= "<td style=\"width: 50%; vertical-align: top\">\n";
			$r .= "<div id=\"mw-pages\">\n";
			$r .= '<h2>' . Answer::getSpecialCategory( 'answered' ) . '</h2>';
			$r .= wfMsgExt( 'answers-category-count-answered', 'parsemag', count( $catView->answers['answered_questions'] ) );
			$r .= "<ul>\n";
			foreach ( $catView->answers['answered_questions'] as $q ) {
				$r .= "<li>$q</li>\n";
			}
			$r .= "</ul>\n";
			$r .= "</div>\n";
			//if ( $wgUser->isAnon() ) {
			//	$r .= AdEngine::getInstance()->getPlaceHolderDiv( 'ANSWERSCAT_BOXAD_A' );
			//}
			$r .= "</td>\n";
		}

		if ( !empty( $catView->answers['unanswered_questions'] ) ) {
			$r .= "<td style=\"width: 50%; vertical-align: top\">\n";
			$r .= "<div id=\"mw-pages\">\n";
			$r .= '<h2>' . str_replace( '-', '', Answer::getSpecialCategory( 'unanswered' ) ) . '</h2>';
			$r .= wfMsgExt( 'answers-category-count-unanswered', 'parsemag', count( $catView->answers['unanswered_questions'] ) );
			$r .= "<ul>\n";
			foreach ( $catView->answers['unanswered_questions'] as $q ) {
				$r .= "<li>$q</li>\n";
			}
			$r .= "</ul>\n";
			$r .= "</div>\n";
			//if ( $wgUser->isAnon() ) {
			//	$r .= AdEngine::getInstance()->getPlaceHolderDiv( 'ANSWERSCAT_BOXAD_U' );
			//}
			$r .= "</td>\n";
		}

		$r .= "</tr></table>\n";

		# replaced by BOXADs per #19020
		#if ( $wgUser->isAnon() && ( !empty( $catView->answers['unanswered_questions'] ) || !empty( $catView->answers['answered_questions'] ) ) ) {
		#	$r .= AdEngine::getInstance()->getPlaceHolderDiv( 'ANSWERSCAT_LEADERBOARD_B' );
		#}

		/*
		$dbcnt = $cat->getPageCount() - $cat->getSubcatCount() - $cat->getFileCount();
		$rescnt = count( $catView->answers );

		if ( $rescnt > 0 ) {
			$r = "<div id=\"mw-pages\">\n";
			$r .= '<h2>' . wfMsg( 'blog-header', $ti ) . "</h2>\n";
			$r .= $catView->formatList( $catView->blogs, $catView->blogs_start_char );
			$r .= "\n</div>";
		}
		*/

		return true;
	}

	/**
	 * For Magic Answer, override the text in the edit box if it is passed in
	 * the request.
	 *
	 * @param $editor EditPage: instance of EditPage
	 * @return Boolean: true
	 */
	public static function displayMagicAnswer( $editor ) {
		if ( !empty( $_GET['magicAnswer'] ) ) {
			$escapedAnswer = addslashes( $_GET['magicAnswer'] );
			global $wgOut;
			$html = "
	        <script type='text/javascript'>
			function magicAnswerCallback( result ) {
				// if ( console.dir ) { console.dir( result ); }
				try {
					document.getElementById( 'wpTextbox1' ).value += result.all.questions[0]['ChosenAnswer'];
				} catch ( e ) {
					// if ( console.dir ) { console.dir( e ); }
				}
			}
		jQuery( '#wpTextbox1' ).ready( function() {
			MagicAnswer.getAnswer( \"$escapedAnswer\", 'magicAnswerCallback' );
			addCategory( \"[[\" + wgFormattedNamespaces[14] + \":Powered by Yahoo! Answers]]\" );
		});
		</script>\n";
			$wgOut->addHTML( $html );
		}

		return true;
	}

	public static function redirectOnMove( &$title, &$newTitle, &$user, $oldid, $newid ) {
		global $wgOut;
		$wgOut->redirect( $newTitle->getFullURL() );
		return true;
	}

	public static function customMoveForm( &$newTitle, &$oldTitle, &$form ) {
		$form = new CustomMovePageForm( $newTitle, $oldTitle );
		return true;
	}

	public static function questionAttributionRegister( $user ) {
		global $wgOut;

		fnWatchHeldPage( $user );

		// anon has asked a question and then registered, so we have to give
		// them attribution
		if (
			isset( $_SESSION['wsQuestionAsk'] ) &&
			$_SESSION['wsQuestionAsk'] != ''
		)
		{
			fnQuestionAttribution( $user );
			$title = Title::newFromText( $_SESSION['wsQuestionAsk'] );
			unset( $_SESSION['wsQuestionAsk'] );
			$wgOut->redirect( $title->getFullURL( 'state=registered' ) );
		}

		return true;
	}

	public static function questionAttributionLogin( $user ) {
		global $wgOut;

		fnWatchHeldPage( $user );

		// anon has asked a question and then logged in, so we have to give
		// them attribution
		if (
			isset( $_SESSION['wsQuestionAsk'] ) &&
			$_SESSION['wsQuestionAsk'] != ''
		)
		{
			fnQuestionAttribution( $user );
			$title = Title::newFromText( $_SESSION['wsQuestionAsk'] );
			unset( $_SESSION['wsQuestionAsk'] );
			$wgOut->redirect( $title->getFullURL() );
		}

		return true;
	}

	/**
	 * Show the 10 most recent questions that the user has asked on the user's
	 * profile (left side).
	 *
	 * @param $user_profile UserProfilePage
	 * @return Boolean: true
	 */
	public static function showAskedQuestionsOnUserProfile( $user_profile ) {
		global $wgOut;

		$html = '<div class="user-section-heading">
		<div class="user-section-title">' .
			wfMessage( 'recent_asked_questions' )->plain() .
		'</div>
		<div class="cleared"></div>
		</div>
		<div class="cleared"></div>
		<div class="profile-info-container">';

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			array( 'page', 'recentchanges' ),
			array( 'page_title', 'rc_timestamp' ),
			array(
				'page_id = rc_cur_id',
				'rc_new' => 1,
				'rc_user' => $user_profile->user_id,
				'page_namespace' => NS_ANSWER,
				'page_is_redirect' => 0
			),
			__METHOD__,
			array( 'ORDER BY' => 'rc_timestamp DESC', 'LIMIT' => 10 )
		);

		if ( $dbr->numRows( $res ) === 0 ) {
			// When the user hasn't asked anything (the DB query above returned
			// no results), display an informational message in the social profile
			// page, because this section is always shown.
			// ->parse() is used for silly things like GENDER, which some
			// languages "require" (I say "require" because MediaWiki worked
			// just fine for years without that magic word & support for it)
			$html .= wfMessage( 'answers-no-recently-asked-questions', $user_profile->user_name )->parse();
		} else {
			foreach ( $res as $row ) {
				$questionTitle = Title::makeTitle( NS_ANSWER, $row->page_title );
				// question mark might already be there
				$question = $questionTitle->getText();
				if ( $question[strlen( $question ) - 1] != '?' ) {
					$question = $question . '?';
				}
				$html .= '<div><a href="' . htmlspecialchars( $questionTitle->getFullURL() ) . '">' .
					$question . '</a></div>';
			}
		}

		$html .= '</div>';

		$wgOut->addHTML( $html );

		return true;
	}

	/**
	 * Show the 10 most recent questions that the user has answered to on the
	 * user's profile (right side).
	 *
	 * @param $user_profile UserProfilePage
	 * @return Boolean: true
	 */
	public static function showAnsweredQuestionsOnUserProfile( $user_profile ) {
		global $wgOut;

		$html = '<div class="user-section-heading">
		<div class="user-section-title">' .
			wfMessage( 'recent_edited_questions' )->plain() .
		'</div>
		<div class="cleared"></div>
	</div>
	<div class="cleared"></div>
		<div class="profile-info-container">';

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			array( 'page', 'recentchanges' ),
			array( 'DISTINCT(page_id)', 'page_title' ),
			array(
				'page_id = rc_cur_id',
				'rc_new' => 0,
				'rc_user' => $user_profile->user_id,
				'page_namespace' => NS_ANSWER,
				'page_is_redirect' => 0
			),
			__METHOD__,
			array( 'ORDER BY' => 'rc_timestamp DESC', 'LIMIT' => 10 )
		);

		if ( $dbr->numRows( $res ) === 0 ) {
			// When the user hasn't edited anything (the DB query above returned
			// no results), display an informational message in the social profile
			// page, because this section is always shown.
			// ->parse() is used for silly things like GENDER, which some
			// languages "require" (I say "require" because MediaWiki worked
			// just fine for years without that magic word & support for it)
			$html .= wfMessage( 'answers-no-recently-edited-questions', $user_profile->user_name )->parse();
		} else {
			foreach ( $res as $row ) {
				$questionTitle = Title::makeTitle( NS_ANSWER, $row->page_title );
				// question mark might already be there
				$question = $questionTitle->getText();
				if ( $question[strlen( $question ) - 1] != '?' ) {
					$question = $question . '?';
				}
				$html .= '<div><a href="' . htmlspecialchars( $questionTitle->getFullURL() ) . '">' .
					$question . '</a></div>';
			}
		}

		$html .= '</div>';

		$wgOut->addHTML( $html );

		return true;
	}

	/**
	 * Removes category [[Category:Un-answered questions]] if any non-category
	 * content is saved to the page.
	 *
	 * @param $editpage EditPage: instance of EditPage
	 * @return Boolean: true
	 */
	public static function markAsAnswered( $editpage ) {
		global $wgRequest;

		$answered = Answer::getSpecialCategoryTag( 'answered' );
		$unanswered = Answer::getSpecialCategoryTag( 'unanswered' );

		if ( !Answer::newFromTitle( $editpage->mTitle )->isQuestion( false, false ) ) {
			return true;
		}

		if ( Title::newFromRedirect( $editpage->textbox1 ) != null ) {
			return true;
		}

		if ( Answer::isMarkedForDeletion( $editpage->textbox1 ) ) {
			$editpage->textbox1 = trim(
				str_ireplace(
					array( $answered, $unanswered ),
					'',
					$editpage->textbox1
				)
			);
			return true;
		}

		if ( Answer::isContentAnswered( $editpage->textbox1 ) ) {
			$editpage->textbox1 = trim( str_ireplace( $unanswered , '', $editpage->textbox1 ) );
			if ( strpos( $editpage->textbox1, $answered ) === false ) {
				$editpage->textbox1 = $editpage->textbox1 . "\n" . $answered;
			}
		} else {
			$editpage->textbox1 = trim( str_ireplace( $answered , '', $editpage->textbox1 ) );
			if ( strpos( $editpage->textbox1, $unanswered ) === false ) {
				$editpage->textbox1 = $unanswered . "\n" . $editpage->textbox1;
			}
		}

		$editpage->textbox1 = trim( $editpage->textbox1 );

		return true;
	}

	public static function addJSGlobalVariables( &$vars, OutputPage $out ) {
		$title = $out->getTitle();

		#$vars['wgAskFormTitle'] = wfMsgForContent( 'ask_a_question' );
		#$vars['wgAskFormCategory'] = wfMsgForContent( 'in_category' );
		$vars['wgAnswerMsg'] = wfMsg( 'answer_title' );
		$vars['wgIsQuestion'] = Answer::newFromTitle( $title )->isQuestion();
		$vars['wgIsAnswered'] = Answer::newFromTitle( $title )->isArticleAnswered();
		$vars['wgAnsweredCategory'] = Answer::getSpecialCategory( 'answered' );
		$vars['wgUnAnsweredCategory'] = Answer::getSpecialCategory( 'unanswered' );
		$vars['wgUnansweredRecentChangesURL'] = htmlspecialchars( SpecialPage::getTitleFor( 'RecentChangesLinked' )->getFullURL() ) . '/' .
			Title::makeTitle( NS_CATEGORY, Answer::getSpecialCategory( 'unanswered' ) )->getPrefixedText();

		global $wgMinimalPasswordLength;
		$vars['wgMinimalPasswordLength'] = $wgMinimalPasswordLength;

		global $wgAfterContentAndJS;
		$vars['wgAfterContentAndJS'] = ( $wgAfterContentAndJS ? $wgAfterContentAndJS : array() );

		global $wgAnswersRecentUnansweredQuestionsLimit;
		$vars['recent_questions_limit'] = ( $wgAnswersRecentUnansweredQuestionsLimit ? $wgAnswersRecentUnansweredQuestionsLimit : HomePageList::RECENT_UNANSWERED_QUESTIONS_LIMIT );

		return true;
	}

	/**
	 * Adds a new user preference, hidefromattribution, which users can check
	 * if they don't want to show up in the contributor lists.
	 *
	 * @param $user User: current User object
	 * @param $preferences Preferences: Preferences object for the current User
	 * @return Boolean: true
	 */
	public static function addHideAttributtionToggle( $user, &$preferences ) {
		$preferences['hidefromattribution'] = array(
			'type' => 'toggle',
			'label-message' => 'tog-hidefromattribution', // a system message
			'section' => 'personal/info',
		);
		return true;
	}

	public static function hideFooter( $skin, &$tpl, &$custom_article_footer ) {
		$custom_article_footer = '<!-- Blank comment to remove article footer for answers via ' .
			__METHOD__ . "-->\n";
		return true;
	}

	/**
	 * Adds a question mark to the title
	 *
	 * @param OutputPage $out
	 * @param ParserOutput $parserOutput
	 * @return Boolean
	 */
	 public static function addQuestionMarkTitle( &$out, $parserOutput ) {
		$title = Answer::newFromTitle( $out->getTitle() );
		if ( $title->isQuestion( $title ) ) {
			$parserOutput->setTitleText( $parserOutput->getTitleText() . wfMessage( 'question_mark' )->plain() );
		}
		return true;
	}
}