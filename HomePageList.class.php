<?php
/**
 * @file
 * @ingroup Extensions
 */
class HomePageList {
	const CACHE_EXPIRE = 900; // memcached & parser cache expiration time (15 minutes; 60 * 15 = 900)
	const RECENT_UNANSWERED_QUESTIONS_LIMIT = 15;

	/**
	 * Register the <homepage_new_questions> and
	 * <homepage_recently_answered_questions> tags with the parser.
	 *
	 * @param $parser Parser: instance of Parser (not necessarily $wgParser)
	 * @return Boolean: true
	 */
	public static function registerParserHooks( &$parser ) {
		$parser->setHook(
			'homepage_new_questions',
			array( 'HomePageList', 'homepage_new_questions_tag' )
		);
		$parser->setHook(
			'homepage_recently_answered_questions',
			array( 'HomePageList', 'homepage_recently_answered_questions_tag' )
		);
		return true;
	}

	function recent_unanswered_questions( $isAjax = false ) {
		global $wgRequest;

		if ( $isAjax ) {
			$cmstart = $wgRequest->getVal( 'cmstart' );
			$cmend = $wgRequest->getVal( 'cmend' );

			$param = array();
			if ( !empty( $cmstart ) ) {
				$param['cmstart'] = $cmstart;
			}
			if ( !empty( $cmend ) ) {
				$param['cmend'] = $cmend;
			}

			return self::_recent_unanswered_questions( $param, /* ignore cache? */ true );
		} else {
			return self::_recent_unanswered_questions();
		}
	}

	/**
	 * Get the most recent unanswered questions.
	 *
	 * @param $param Array: array of additional parameters for the API call
	 * @param $ignoreCache Boolean: should we not even try memcached and just
	 *                              perform a database query?
	 */
	function _recent_unanswered_questions( $param = array(), $ignoreCache = false ) {
		global $wgMemc, $wgAnswersRecentUnansweredQuestionsLimit;
		wfProfileIn( __METHOD__ );

		$mkey = wfMemcKey( 'HPL', 'recent_unanswered_questions' );
		$html = $ignoreCache ? '' : $wgMemc->get( $mkey );
		if ( empty( $html ) ) {
			if ( $wgAnswersRecentUnansweredQuestionsLimit ) {
				$limitForAPI = $wgAnswersRecentUnansweredQuestionsLimit;
			} else {
				$limitForAPI = self::RECENT_UNANSWERED_QUESTIONS_LIMIT;
			}
			$req = new FauxRequest(
				array_merge(
				array(
					'action'      => 'query',
					'list'        => 'categorymembers',
					'cmtitle'     => 'Category:' . wfMessage( 'unanswered_category' )->inContentLanguage()->text(),
					'cmnamespace' => 0,
					'cmprop'      => 'title|timestamp',
					'cmsort'      => 'timestamp',
					'cmdir'       => 'desc',
					'cmlimit'     => $limitForAPI,
				),
				$param
			) );

			$api = new ApiMain( $req );
			$api->execute();
			$res = $api->getResultData();

			if ( $res['query']['categorymembers'] ) {
				$timestamp1 = '';
				foreach ( $res['query']['categorymembers'] as $recent_q => $ignoreMe ) {
					$page = $res['query']['categorymembers'][$recent_q];
					$url = str_replace( ' ', '_', $page['title'] );

					$question = new DefaultQuestion( $url );
					if (
						!is_null( $question ) &&
						!$question->badWordsTest() &&
						!$question->filterWordsTest()
					)
					{
						$text = $page['title'] . '?';
						$timestamp = $page['timestamp'];
						$html .= '<li><a href="/wiki/' . urlencode( $url ) .
							'">' .//"\" onclick=\"WET.byStr('unanswered/click')\">" .
							htmlspecialchars( Answer::s2q( $text ) ) .
							'</a></li>';

						if ( empty( $timestamp1 ) ) {
							$timestamp1 = $timestamp;
						}
					}
					unset( $question );
				}

				if ( !empty( $timestamp ) ) {
					$html .= "<span id=\"timestamp1\" style=\"display: none\">{$timestamp1}</span>";
					$html .= "<span id=\"timestamp\" style=\"display: none\">{$timestamp}</span>";
				}
			}

			$wgMemc->set( $mkey, $html, self::CACHE_EXPIRE );
		}

		wfProfileOut( __METHOD__ );
		return $html;
	}

	/**
	 * Get the related answered questions; in AJAX mode, this uses the title
	 * parameter from the request, in non-AJAX mode, $wgTitle (which is evil)
	 * is used instead.
	 *
	 * @param $isAjax Boolean: called from AJAX?
	 * @return String: HTML
	 */
	function related_answered_questions( $isAjax = false ) {
		global $wgRequest, $wgTitle;

		if ( $isAjax ) {
			$title = $wgRequest->getVal( 'title' );
			if ( empty( $title ) ) {
				return '';
			}

			$title = Title::newFromText( $title );
			if ( !is_object( $title ) || !( $title instanceof Title ) ) {
				return '';
			}

			return self::_related_answered_questions( $title, /* ignore cache */ true );
		} else {
			return self::_related_answered_questions( $wgTitle );
		}
	}

	function _related_answered_questions( $title, $ignoreCache = false ) {
		return self::_related_questions(
			'related_answered_questions', 'yes', $title, $ignoreCache
		);
	}

	/**
	 * Get the related unanswered questions; in AJAX mode, this uses the title
	 * parameter from the request, in non-AJAX mode, $wgTitle (which is evil)
	 * is used instead.
	 *
	 * @param $isAjax Boolean: called from AJAX?
	 * @return String: HTML
	 */
	function related_unanswered_questions( $isAjax = false ) {
		global $wgRequest, $wgTitle;

		if ( $isAjax ) {
			$title = $wgRequest->getVal( 'title' );
			if ( empty( $title ) ) {
				return '';
			}

			$title = Title::newFromText( $title );
			if ( !is_object( $title ) || !( $title instanceof Title ) ) {
				return '';
			}

			return self::_related_unanswered_questions( $title, /* ignore cache */ true );
		} else {
			return self::_related_unanswered_questions( $wgTitle );
		}
	}

	function _related_unanswered_questions( $title, $ignoreCache = false ) {
		return self::_related_questions(
			'related_unanswered_questions', 'no', $title, $ignoreCache
		);
	}

	/**
	 * Get the related questions for the given title.
	 *
	 * @param $key String: used in the memcached cache key and also to build
	 *                     the name of an interface message
	 * @param $answered String: if 'yes', get answered questions, if 'no', get
	 *                          unanswered questions
	 * @param $title Title: Title object
	 * @param $ignoreCache Boolean: skip memcached and just query the database?
	 */
	function _related_questions( $key, $answered, $title, $ignoreCache = false ) {
		global $wgMemc;
		wfProfileIn( __METHOD__ );

		$category = array();
		foreach ( array_keys( $title->getParentCategories() ) as $c ) {
			$c = preg_replace( '/^.*:/', '', $c );
			$c = str_replace( '_', ' ', $c );
			// ...but skip un/answered cats
			if (
				$c != wfMessage( 'answered_category' )->inContentLanguage()->text() &&
				$c != wfMessage( 'unanswered_category' )->inContentLanguage()->text()
				// c is dbkey, wgVars are plain text - utf fail if wgVars contain utf
			)
			{
				$category[] = str_replace( ' ', '_', $c );
			}
		}
		sort( $category );
		$category = implode( '|', $category );

		if ( !empty( $category ) ) {
			$mkey = wfMemcKey( 'HPL', $key, $category );
			$html = $ignoreCache ? '' : $wgMemc->get( $mkey );
			if ( empty( $html ) ) {
				$req = new FauxRequest(
					array(
						'action'      => 'query',
						'list'        => 'categoriesonanswers',
						'coatitle'    => $category,
						'coaanswered' => $answered,
						'coalimit'    => 5,
					)
				);
				$api = new ApiMain( $req );
				$api->execute();
				$res = $api->getResultData();

				if (
					isset( $res['query'] ) &&
					isset( $res['query']['categoriesonanswers'] )
				)
				{
					foreach ( $res['query']['categoriesonanswers'] as $recent_q => $ignoreMe ) {
						$page = $res['query']['categoriesonanswers'][$recent_q];
						if ( $title->getText() == $page['title'] ) {
							continue;
						}
						$url  = str_replace( ' ', '_', $page['title'] );
						$question = new DefaultQuestion( $url );
						if (
							!is_null( $question ) &&
							!$question->badWordsTest() &&
							!$question->filterWordsTest()
						)
						{
							$text = $page['title'] . '?';
							$html .= '<li><a href="/wiki/' . urlencode( $url ) .
								'">' .//"\" onclick=\"WET.byStr('{$key}')\">" .
								htmlspecialchars( Answer::s2q( $text ) ) .
								'</a></li>';
						}
					}
				}

				$wgMemc->set( $mkey, $html, self::CACHE_EXPIRE );
			}
		}

		if ( empty( $html ) ) {
			$html = wfMessage( "no_{$key}" )->parse(); // I guess parse is the correct thing to use here...
		}

		wfProfileOut( __METHOD__ );
		return $html;
	}

	function homepage_new_questions_tag( $input, $argv, $parser ) {
		global $wgParserCacheExpireTime;
		$wgParserCacheExpireTime = self::CACHE_EXPIRE;

		return self::homepage_new_questions();
	}

	function homepage_new_questions( $isAjax = false ) {
		$msg = wfMessage( 'unanswered_category' )->inContentLanguage()->text();

		return self::_homepage_questions(
			'homepage_new_questions', $msg, /* ignore cache */ $isAjax
		);
	}

	function homepage_recently_answered_questions_tag( $input, $argv, $parser ) {
		global $wgParserCacheExpireTime;
		$wgParserCacheExpireTime = self::CACHE_EXPIRE;

		return self::homepage_recently_answered_questions();
	}

	function homepage_recently_answered_questions( $isAjax = false ) {
		$msg = wfMessage( 'answered_category' )->inContentLanguage()->text();

		return self::_homepage_questions(
			'homepage_recently_answered_questions',
			 Title::newMainPage(),
			/* ignore cache */ $isAjax
		);
	}

	/**
	 * Get the questions for the home page of the wiki for the given title.
	 *
	 * @param $key String: used in the memcached cache key and also to build
	 *                     the name of an interface message
	 * @param $title Title: Title object
	 * @param $ignoreCache Boolean: skip memcached and just query the database?
	 * @return String: HTML
	 */
	function _homepage_questions( $key, $title, $ignoreCache = false ) {
		global $wgMemc;
		wfProfileIn( __METHOD__ );

		$mkey = wfMemcKey( 'HPL', $key );
		$html = $ignoreCache ? '' : $wgMemc->get( $mkey );
		if ( empty( $html ) ) {
			$req = new FauxRequest( array(
				'action'      => 'query',
				'list'        => 'categorymembers',
				'cmtitle'     => 'Category:' . $title,
				'cmnamespace' =>  0,
				'cmprop'      => 'title|timestamp',
				'cmsort'      => 'timestamp',
				'cmdir'       => 'desc',
				'cmlimit'     => 5,
			) );
			$api = new ApiMain( $req );
			$api->execute();
			$res = $api->getResultData();

			if ( $res['query']['categorymembers'] ) {
				foreach ( $res['query']['categorymembers'] as $recent_q => $ignoreMe ) {
					$page = $res['query']['categorymembers'][$recent_q];
					$url = str_replace( ' ', '_', $page['title'] );
					$question = new DefaultQuestion( $url );
					if (
						!is_null( $question ) &&
						!$question->badWordsTest() &&
						!$question->filterWordsTest()
					)
					{
						$text = $page['title'] . '?';
						$html .= '<li><a href="/wiki/' .
							htmlspecialchars( $url ) .
							'">' . //"\" onclick=\"WET.byStr('mainpage/{$key}')\">" .
							htmlspecialchars( Answer::s2q( $text ) ) .
							'</a></li>';
					}
				}
			}

			$wgMemc->set( $mkey, $html, self::CACHE_EXPIRE );
		}

		wfProfileOut( __METHOD__ );
		return $html;
	}
}