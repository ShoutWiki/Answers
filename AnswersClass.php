<?php

class Answer {

	/**
	 * @var Title
	 */
	public $title;

	/**
	 * @var Array: array containing the localized names of the
	 * answered/unanswered categories
	 */
	static $special_categories = array();

	/**
	 * Set the title class member variable.
	 *
	 * @param $title Title
	 */
	function __construct( Title $title ) {
		$this->title = $title;
	}

	/**
	 * Create a new Answer object from the given Title object.
	 *
	 * @param $title Title
	 * @return Answer
	 */
	public static function newFromTitle( $title ) {
		$a = new Answer( $title );
		return $a;
	}

	/**
	 * Is the current Title a question page? Existing pages in the main
	 * namespace that are not the main page are counted as questions.
	 *
	 * @param $checkExistence Boolean: check whether the page exists?
	 * @param $checkAction Boolean: check the action parameter too?
	 * @return Boolean: true if it's a question, else false
	 */
	public function isQuestion( $checkExistence = false, $checkAction = true ) {
		if ( $checkExistence ) {
			if ( $this->title->getArticleID() == 0 ) {
				return false;
			}
		}

		if ( $checkAction ) {
			global $wgRequest;

			$action = $wgRequest->getVal( 'action', 'view' );

			if ( !in_array( $action, array( 'view', 'purge' ) ) ) {
				return false;
			}
		}

		if ( $this->title->getText() == wfMsgForContent( 'mainpage' ) ) {
			return false;
		}

		if ( $this->title->getNamespace() == NS_ANSWER ) {
			return true;
		}

		return false;
	}

	protected static function setSpecialCategories() {
		self::$special_categories = array(
			'unanswered' => wfMsgForContent( 'unanswered_category' ),
			'answered' => wfMsgForContent( 'answered_category' )
		);
	}

	public static function getSpecialCategory( $categoryKey ) {
		self::setSpecialCategories();
		return self::$special_categories[$categoryKey];
	}

	public static function getSpecialCategoryTag( $categoryKey ) {
		global $wgContLang;
		$categoryTag = '[[' . $wgContLang->getNsText( NS_CATEGORY ) . ':' .
			self::getSpecialCategory( $categoryKey ) . ']]';
		return $categoryTag;
	}

	/**
	 * Remove categories from the given text.
	 *
	 * @param $content String
	 * @return String
	 */
	public static function stripCategories( $content ) {
		global $wgContLang;
		$content =  preg_replace(
			"@\[\[" . $wgContLang->getNsText( NS_CATEGORY ) . ":[^\]]*?].*?\]@si",
			'',
			$content
		);
		$content = trim( $content );
		return $content;
	}

	/**
	 * Remove [[File:]]s from the given text.
	 *
	 * @param $content String
	 * @return String
	 */
	public static function stripImages( $content ) {
		global $wgContLang;
		$content =  preg_replace(
			"@\[\[" . $wgContLang->getNsText( NS_FILE ) . ":[^\]]*?].*?\]@si",
			'',
			$content
		);
		$content = trim( $content );
		return $content;
	}

	/**
	 * Remove interlanguage links from the given text.
	 *
	 * @param $content String
	 * @return String
	 */
	public static function stripInterlang( $content ) {
		global $wgContLang;
		$lang_mask = '(' . join( '|', array_keys( Language::getLanguageNames() ) ) . ')';
		$content = preg_replace(
			"@\[\[" . $lang_mask . ":[^\]]*?].*?\]@si",
			'',
			$content
		);
		$content = trim( $content );
		return $content;
	}

	/**
	 * @return Boolean: is this a question page and has the question been
	 * answered?
	 */
	public function isArticleAnswered() {
		if ( !self::isQuestion() ) {
			return false;
		}

		$article = new Article( $this->title );
		$content = $article->getContent();

		return self::isContentAnswered( $content );
	}

	/**
	 * Get the name of the deletion template from [[MediaWiki:DeleteTemplate]].
	 *
	 * @return String: delete template text or false on failure
	 */
	public static function getDeletionTemplateName() {
		$deleteNameTitle = Title::makeTitle( NS_MEDIAWIKI, 'DeleteTemplate' );
		$deleteNameArticle = new Article( $deleteNameTitle );
		$deleteTemplate = $deleteNameArticle->followRedirect();
		if ( is_object( $deleteTemplate ) ) {
			return $deleteTemplate->getText();
		}
		return false;
	}

	/**
	 * Check whether the given page is marked for deletion.
	 *
	 * @param $content String: page content
	 * @return Boolean: true if it's marked for deletion, else false
	 */
	public static function isMarkedForDeletion( $content ) {
		$marked = preg_match(
			'/\s{{' . self::getDeletionTemplateName() . '(\|.*?)?}}/i',
			$content
		);
		if ( $marked ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Has the given question been answered?
	 *
	 * @param $content String
	 * @return Boolean: true if it's been answered, else false
	 */
	public static function isContentAnswered( $content ) {
		$content = self::stripCategories( $content );
		$content = self::stripImages( $content );
		$content = self::stripInterlang( $content );
		if ( $content != '' ) {
			return true;
		} else {
			return false;
		}
	}

	function getOriginalAuthor() {
		global $wgMemc;

		$page_title_id = $this->title->getArticleID();

		$key = wfMemcKey( 'answer_author', $page_title_id, 3 );
		$data = $wgMemc->get( $key );

		$author = array();
		if ( empty( $data ) ) {
			wfDebug( "Loading author for question {$page_title_id} from DB\n" );
			$dbr = wfGetDB( DB_SLAVE );

			$s = $dbr->selectRow(
				'revision',
				array( 'rev_user', 'rev_user_text', 'rev_timestamp' ),
				array( 'rev_page' => $page_title_id ),
				__METHOD__,
				array( 'ORDER BY' => 'rev_id ASC', 'LIMIT' => 1 )
			);

			$avatarImg = Answer::getUserAvatar( $s->rev_user, 30, 30 );

			$user_title = Title::makeTitle( NS_USER, $s->rev_user_text );

			$author = array(
				'user_id' => $s->rev_user,
				'user_name' => $s->rev_user_text,
				'title' => $user_title,
				'avatar' => $avatarImg,
				'ts' => $s->rev_timestamp
			);

			$wgMemc->set( $key, $author, 60 * 60 );
		} else {
			wfDebug( "Loading author for question for page {$page_title_id} from cache\n" );
			$author = $data;
		}

		return $author;
	}

	public function getContributors() {
		return AttributionCache::getInstance()->getArticleContribs( $this->title );
	}

	public static function getUserEditPoints( $userId ) {
		return AttributionCache::getInstance()->getUserEditPoints( $userId );
	}

	public static function getUserAvatar( $userId, $width = 50, $height = 50 ) {
		global $wgStylePath;

		wfProfileIn( __METHOD__ );

		if ( class_exists( 'wAvatar' ) ) { // SocialProfile's avatar class
			$avatar = new wAvatar( $userId, 'm' );
			$img = $avatar->getAvatarURL();
		} elseif ( class_exists( 'Masthead' ) ) {
			$avatar = Masthead::newFromUserID( $userId );
			$avatar->getDefaultAvatars();
			$avatar->mDefaultAvatars = array( "{$wgStylePath}/answers/images/default_avatar.png?1" );
			$img = $avatar->getImageTag( $width, $height );
		} else {
			$avatarImgSrc = $wgStylePath . '/Monaco/monaco/images/blank.gif';
			$img = Xml::element( 'img', array(
				'src' => $avatarImgSrc,
				'height' => $height,
				'width' => $width,
			) );
		}

		wfProfileOut( __METHOD__ );

		return $img;
	}

	// Convenience function for getting the non-image version of the badge.
	public static function getSmallUserBadge( $userData ) {
		return getUserBadge( $userData, false );
	}

	/**
	 * Given an array of user-data, returns the HTML for a badge representation.
	 * If largeFormat is true (default), then the larger format including the
	 * avatar image will be used; otherwise, a compact version will be used.
	 *
	 * The userData is expected to be an associative array containing the keys
	 * 'user_id', 'user_name', and 'edits'.
	 */
	public static function getUserBadge( $userData, $largeFormat = true ) {
		$ret = '';

		// get avatar
		$ret .= Xml::openElement( 'div', array( 'class' => 'userInfoBadge' ) );
		if ( $largeFormat ) {
			$ret .= Xml::openElement( 'div', array( 'class' => 'userInfoBadgeAvatarWrapper' ) );
			$avatarImg = Answer::getUserAvatar( $userData['user_id'] );
			$ret .= $avatarImg;
			$ret .= Xml::closeElement( 'div' );
		}

		// render user info
		$class = 'userInfo';
		$class .= ( $largeFormat? '' : ' userInfoNoAvatar' );
		$ret .= Xml::openElement( 'div', array( 'class' => $class ) );

		if ( $userData['user_name'] == 'helper' ) {
			// anonymous users
			$ret .= Xml::element(
				'span',
				array( 'class' => 'userPageLink' ),
				wfMsg( 'unregistered' )
			);
			$ret .= Xml::element(
				'span',
				array( 'class' => 'anonEditPoints' ),
				wfMsgExt( 'anonymous_edit_points', 'parsemag', array( $userData['edits'] ) )
			);
		} else {
			// link to user page
			$userPage = Title::newFromText( $userData['user_name'], NS_USER );
			$userPageLink = !empty( $userPage ) ? $userPage->getLocalURL() : '';

			if ( $largeFormat ) {
				$ret .= Xml::element(
					'a',
					array(
						'href' => $userPageLink,
						'class' => 'userPageLink'
					),
					$userData['user_name']
				);

				// user points
				$ret .= Xml::openElement( 'div', array( 'class' => 'userEditPoints' ) );
				$ret .= Xml::openElement( 'nobr' );
				$ret .= Xml::element(
					'span',
					array(
						'class' => "userPoints userDatas-user-points-{$userData['user_id']}",
						'timestamp' => wfTimestampNow()
					),
					$userData['edits']
				);
				$ret .= ' '; // space for graceful degradation
				$ret .= wfMsgExt( 'edit_points', 'parsemag', array( $userData['edits'] ) );
				$ret .= Xml::closeElement( 'nobr' );
				$ret .= Xml::closeElement( 'div' ); // END .userEditPoints
			} else {
				$ret .= Xml::openElement( 'div', array( 'style' => 'float:left;' ) );
				$ret .= Xml::element(
					'a',
					array(
						'href' => $userPageLink,
						'class' => 'userPageLink'
					),
					$userData['user_name']
				);
				$ret .= Xml::closeElement( 'div' ); // END .userEditPoints

				$ret .= ' '; // space for graceful degradation
				$ret .= Xml::element(
					'div',
					array(
						'class' => "userPoints userDatas-user-points-{$userData['user_id']}",
						'style' => 'display:inline',
						'timestamp' => wfTimestampNow()
					),
					$userData['edits']
				);
			}
		}

		$ret .= Xml::closeElement( 'div' ); // END .userInfo
		$ret .= Xml::closeElement( 'div' ); // END .userInfoBadge
		return $ret;
	}

	/**
	 * Converts a string to a question (adds language-appropriate question marks).
	 *
	 * @param $string String: question title
	 * @return String
	 */
	public static function s2q( $string ) {
		$string = self::q2s( $string );

		global $wgContLang;
		$lang = $wgContLang->getCode();
		if ( $lang == 'es' ) {
			return '¿' . $string . '?';
		}
		if ( $lang == 'fr' ) {
			return $string . ' ?';
		}

		return $string . '?';
	}

	/**
	 * Converts a question to a string w/out question marks.
	 *
	 * @param $string String: question title
	 * @return String
	 */
	public static function q2s( $question ) {
		return ucfirst( trim( $question, "¿? \t\n\r\0\x0B" ) );
	}
}