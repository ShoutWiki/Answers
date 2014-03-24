<?php

class CreateQuestionPage extends UnlistedSpecialPage {

	public function __construct() {
		parent::__construct( 'CreateQuestionPage' );
	}
	
	public function execute( $question ) {
		$out = $this->getOutput();
		$request = $this->getRequest();
		$user = $this->getUser();

		// don't allow users who don't have edit permission to ask questions
		if ( !$user->isAllowed( 'edit' ) ) {
			return false;
		}

		// don't allow questions if the wiki is in read-only mode
		if ( wfReadOnly() ) {
			return false;
		}

		// don't allow blocked users to ask questions, duh
		if ( $user->isBlocked() ) {
			$out->blockedPage( false );
			return false;
		}

		
		if ( empty( $question ) ) {
			$question = $request->getVal( 'questiontitle' );
		}

		if ( empty( $question ) ) {
			return true;
		}

		$q = new DefaultQuestion( $question );

		if ( !is_object( $q ) ) {
			return false;
		}

		if ( is_object( $q->title ) && $q->title->exists() ) {
			$out->redirect( $q->title->getFullURL() );
			return false;
		}

		if ( $q->searchTest() ) {
			$srch = SpecialPage::getTitleFor( 'Search' );
			$out->redirect( $srch->getFullURL( 'search=' . $q->question . '&fulltext=Search' ) );
			return false;
		}

		$res = $q->create();

		if ( $res ) {
			$out->redirect( $q->title->getFullURL( 'state=asked' ) );
		} else {
			$out->redirect( Title::makeTitle( NS_MAIN, wfMessage( 'question_redirected_help_page' )->inContentLanguage()->text() )->getFullURL() );
		}

		return false;
	}
}
