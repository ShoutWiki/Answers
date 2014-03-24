<?php
/**
 * Originally used only by NewWikiBuilder, nowadays used by WikiBuilder.
 *
 * @file
 * @author Bartek Łapiński <bartek@wikia-inc.com>
 */
class PrefilledDefaultQuestion extends DefaultQuestion {
	function create( $text ) {
		global $wgOut, $wgUser, $wgContLang;

		if ( wfReadOnly() ) {
			return false;
		}

		if ( $this->badWordsTest() ) {
			return false;
		}

		if ( !wfRunHooks( 'CreateDefaultQuestionPageFilter', array( $this->title ) ) ) {
			return false;
		}

		if ( !$this->title->userCan( 'edit' ) || !$this->title->userCan( 'create' ) ) {
			return false;
		}

		if ( $this->searchTest() ) {
			return false;
		}

		$defaultText = $text . Answer::getSpecialCategoryTag( 'unanswered' );

		// add default category tags passed in
		if ( $this->categories ) {
			$categories_array = explode( '|', $this->categories );
			foreach ( $categories_array as $category ) {
				$defaultText .= "\n[[" .
					$wgContLang->getNsText( NS_CATEGORY ) . ':' .
					$wgContLang->ucfirst( $category ) . ']]';
			}
		}

		$flags = EDIT_NEW;
		$article = new Article( $this->title );
		$article->doEdit(
			$defaultText,
			wfMessage( 'new_question_comment' )->inContentLanguage()->parse(),
			$flags
		);

		if ( $wgUser->isLoggedIn() ) {
			//$stats = new UserStatsTrack( $wgUser->getId(), $wgUser->getName() );
			//$stats->incStatField( 'quiz_created' ); // we'll use this to track how many questions a user created
			$wgUser->addWatch( $this->title );
		}

		// store question in session so we can give attribution if they create an account afterwards
		$_SESSION['wsQuestionAsk'] = '';
		if ( $wgUser->isAnon() ) {
			$_SESSION['wsQuestionAsk'] = $this->question;
		}

		return true;
	}
}