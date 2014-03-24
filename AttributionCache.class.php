<?php
/**
 * Attribution cache for answers articles
 *
 * @file
 */
class AttributionCache {

	static private $instance = null;
	private $contribsCacheTime = 10800; // 3 hours
	private $editPointsCacheTime = 7200; // 2 hours
	private $contribs = array();
	private $editPoints = array();
	private $lastModified = array();
	private $firstEditDate = array();

	private function __construct() { }

	private function __clone() { }

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new AttributionCache;
		}
		return self::$instance;
	}

	private function getArticleContribsFromCache( $articleId ) {
		global $wgMemc;

		if ( !isset( $this->contribs[$articleId] ) ) {
			$key = wfMemcKey( 'AttributionCache', $articleId, 'contribs' );
			$contribs = $wgMemc->get( $key );
			if ( !empty( $contribs ) ) {
				// refresh edit points
				foreach ( $contribs as &$contrib ) {
					if ( $contrib['user_id'] != 0 ) {
						// ignore anons
						$contrib['edits'] = $this->getUserEditPoints(
							$contrib['user_id']
						);
					}
				}
				$contribs = $this->sortContribs( $contribs );
			}
			$this->contribs[$articleId] = $contribs;
		}

		return $this->contribs[$articleId];
	}

	private function setArticleContribsToCache( $articleId, Array $contribs ) {
		global $wgMemc;

		// sort contribs by number of edits first
		$contribs = $this->sortContribs( $contribs );

		$key = wfMemcKey( 'AttributionCache', $articleId, 'contribs' );
		$wgMemc->set( $key, $contribs, $this->contribsCacheTime );
		$this->contribs[$articleId] = $contribs;

		return $contribs;
	}

	public function getArticleContribs( Title $title ) {
		wfProfileIn( __METHOD__ );

		$contribs = $this->getArticleContribsFromCache( $title->getArticleID() );

		if ( empty( $contribs ) ) {
			// rebuild contribs cache
			$contribs = $this->rebuildArticleContribs( $title );
		}

		wfProfileOut( __METHOD__ );
		return $contribs;
	}

	public function getUserLastModifiedFromCache( $userId ) {
		global $wgMemc;

		if ( !isset( $this->lastModified[$userId] ) ) {
			$key = wfMemcKey( 'AttributionCache', $userId, 'edits' );
			$value = $wgMemc->get( $key );
			// check if we have array here
			$this->lastModified[$userId] = is_array( $value ) ? $value['last_modified'] : '';
		}

		return $this->lastModified[$userId];
	}

	public function getUserFirstEditDateFromCache( $userId ) {
		global $wgMemc;

		if ( !isset( $this->firstEditDate[$userId] ) ) {
			$key = wfMemcKey( 'AttributionCache', $userId, 'edits' );
			$value = $wgMemc->get( $key );
			// check if we have array here
			$this->firstEditDate[$userId] = is_array( $value ) ? $value['first_edit'] : '';
		}

		return $this->firstEditDate[$userId];
	}

	private function getUserEditPointsFromCache( $userId ) {
		global $wgMemc;

		if ( !isset( $this->editPoints[$userId] ) ) {
			$key = wfMemcKey( 'AttributionCache', $userId, 'edits' );
			$value = $wgMemc->get( $key );
			// check if we have array here
			$this->editPoints[$userId] = is_array( $value ) ? $value['edits'] : $value;
		}

		return $this->editPoints[$userId];
	}

	private function setUserEditPointsToCache( $userId, $editPoints, $firstEditDate = null ) {
		global $wgMemc;

		$lastModified = wfTimestampNow();
		$value = array(
			'edits' => $editPoints,
			'last_modified' => $lastModified,
			'first_edit' => $firstEditDate
		);

		$key = wfMemcKey( 'AttributionCache', $userId, 'edits' );
		$wgMemc->set( $key, $value, $this->editPointsCacheTime );

		$this->editPoints[$userId] = $editPoints;
		$this->lastModified[$userId] = $lastModified;
		$this->firstEditDate[$userId] = $firstEditDate;
	}

	public function getUserEditPoints( $userId ) {
		wfProfileIn( __METHOD__ );

		$edits = $this->getUserEditPointsFromCache( $userId );

		if ( empty( $edits ) ) {
			// rebuild edit points cache
			$edits = $this->rebuildUserEditPoints( $userId );
		}

		wfProfileOut( __METHOD__ );
		return intval( $edits );
	}

	/**
	 * Rebuild and cache contributors list for an article
	 *
	 * @param $title Title
	 */
	private function rebuildArticleContribs( Title $title ) {
		global $wgAnswerHelperIDs, $wgMemc;
		wfProfileIn( __METHOD__ );

		$results = array();

		$dbw = wfGetDB( DB_MASTER );
		$res = $dbw->select(
			'revision',
			array( 'rev_user', 'rev_user_text' ),
			array( 'rev_page' => $title->getArticleID() ),
			__METHOD__,
			array( 'GROUP BY' => 'rev_user' )
		);

		$firstRevisionUserId = $this->getFirstRevisionUserId( $title );
		foreach ( $res as $row ) {
			if ( !in_array( $row->rev_user, $wgAnswerHelperIDs ) ) {
				$user = User::newFromId( $row->rev_user );
				if ( $user->isBlocked() ) {
					// ignore blocked users
					continue;
				}
				if ( $user->isAllowed( 'bot' ) ) {
					// ignore bots
					continue;
				}
				if ( $user->getBoolOption( 'hidefromattribution' ) ) {
					// allow users to opt out from being shown on the
					// attribution list
					continue;
				}
				if ( $row->rev_user == $firstRevisionUserId ) {
					$pageUserEditPoints = $this->rebuildUserEditPoints(
						$row->rev_user,
						$title->getArticleID()
					);
					if ( $pageUserEditPoints == 1 ) {
						// don't show the asker as one of the answerers (#27081)
						// ...unless they made more than just one edit
						continue;
					}
				}
				$results[] = $this->getContribsEntry(
					$row->rev_user,
					$this->getUserEditPoints( $row->rev_user ),
					$row->rev_user_text
				);
			}
		}

		// get helper's edits
		$answerHelperEdits = 0;
		foreach ( $wgAnswerHelperIDs as $helperId ) {
			$answerHelperEdits += $this->rebuildUserEditPoints( $helperId, $title->getArticleID() );
		}
		if ( $answerHelperEdits > 0 ) {
			$results[] = $this->getContribsEntry( 0, $answerHelperEdits );
		}

		$results = $this->setArticleContribsToCache( $title->getArticleID(), $results );

		wfProfileOut( __METHOD__ );
		return $results;
	}

	public function getFirstRevisionUserId( Title $title ) {
		$dbw = wfGetDB( DB_MASTER );
		$res = $dbw->selectRow(
			'revision',
			array( 'rev_user' ),
			array( 'rev_page' => $title->getArticleID() ),
			__METHOD__,
			array( 'ORDER BY' => 'rev_timestamp ASC', 'LIMIT' => 1 )
		);
		return !empty( $res->rev_user ) ? $res->rev_user : 0;
	}

	private function getContribsEntry( $userId, $editsNum, $userName = '' ) {
		return array(
			'user_id' => $userId,
			'user_name' => ( ( $userId != 0 ) ? $userName : 'helper' ),
			'edits' => $editsNum
		);
	}

	/**
	 * Sort contribs array by number of edits
	 *
	 * @param $contribs Array
	 */
	private function sortContribs( Array $contribs ) {
		if ( count( $contribs ) == 0 ) {
			return $contribs;
		}

		$helpersContrib = null;
		if ( $contribs[count( $contribs ) - 1]['user_id'] == 0 ) {
			// copy helper's entry
			$helpersContrib = $contribs[count( $contribs ) - 1];
			unset( $contribs[count( $contribs ) - 1]);
		}

		$tmpSorted = array();
		$tmpUserNames = array();

		foreach ( $contribs as $contrib ) {
			$tmpSorted[$contrib['user_id']] = $contrib['edits'];
			$tmpUserNames[$contrib['user_id']] = $contrib['user_name'];
		}

		arsort( $tmpSorted );
		$sortedContribs = array();
		foreach ( $tmpSorted as $userId => $editsNum ) {
			$sortedContribs[] = $this->getContribsEntry(
				$userId,
				$editsNum,
				$tmpUserNames[$userId]
			);
		}

		if ( is_array( $helpersContrib ) ) {
			// put helper's entry at the end
			$sortedContribs[] = $helpersContrib;
		}

		return $sortedContribs;
	}

	/**
	 * Rebuild and cache edit points for user
	 *
	 * @param $userId Integer: user ID
	 * @param $pageId Integer: page ID for calculating edits per article
	 */
	private function rebuildUserEditPoints( $userId, $pageId = 0 ) {
		wfProfileIn( __METHOD__ );

		$dbw = wfGetDB( DB_MASTER );
		$tables = array( 'revision' );
		$conditions = array( 'rev_user' => $userId );
		if ( !empty( $pageId ) ) {
			$tables[] = 'page';
			$conditions[] = 'page_id = rev_page';
			$conditions['page_id'] = $pageId;
		}
		$edits = $dbw->selectRow(
			$tables,
			array( 'MIN(rev_timestamp) AS date', 'COUNT(rev_id) AS count' ),
			$conditions,
			__METHOD__
		);

		$editCount = !empty( $edits->count ) ? $edits->count : 0;
		$firstEditDate = !empty( $edits->date ) ? $edits->date : null;

		if ( empty( $pageId ) ) {
			$this->setUserEditPointsToCache( $userId, $editCount, $firstEditDate );
		}

		wfProfileOut( __METHOD__ );
		return $editCount;
	}

	/**
	 * Update article contribs cache if available (without reading data from DB)
	 *
	 * @param $title Title
	 * @param $user User
	 */
	public function updateArticleContribs( Title $title, User $user ) {
		global $wgAnswerHelperIDs;

		if ( in_array( $user->getId(), $wgAnswerHelperIDs ) ) {
			// edit made by anonymous "helper"
			$userId = 0;
		} else {
			// edit made by regular user, update edit points cache as well
			$userId = $user->getId();

			$editPoints = $this->getUserEditPointsFromCache( $userId );
			if ( !empty( $editPoints ) ) {
				$editPoints++;
				$this->setUserEditPointsToCache(
					$userId,
					$editPoints,
					$this->getUserFirstEditDateFromCache( $userId )
				);
			} else {
				// no edit points in cache, get value from DB
				$editPoints = $this->rebuildUserEditPoints( $userId );
			}
		}

		$contribs = $this->getArticleContribsFromCache( $title->getArticleID() );

		if ( !empty( $contribs ) ) {
			$userExists = false;
			foreach ( $contribs as &$contribData ) {
				if ( $contribData['user_id'] == $userId ) {
					$contribData['edits'] = ( $userId == 0 ) ? ( $contribData['edits'] + 1 ) : $editPoints;
					$userExists = true;
					break;
				}
			}

			if ( !$userExists ) {
				// add new entry and cache
				$newEntry = $this->getContribsEntry(
					$userId,
					( ( $userId == 0 ) ? 1 : $editPoints ),
					$user->getName()
				);
				array_unshift( $contribs, $newEntry );
			}

			$this->setArticleContribsToCache( $title->getArticleID(), $contribs );
		} else {
			$this->rebuildArticleContribs( $title );
		}
	}

	public function purge( $title, $user ) {
		global $wgScript, $wgServer;

		AttributionCache::getInstance()->updateArticleContribs( $title, $user );

		// invalidate Varnish cache
		if ( $user->getId() != 0 ) {
			SquidUpdate::purge( array(
				"{$wgServer}{$wgScript}?action=ajax&rs=wfAnswersGetEditPointsAjax&userId={$user->getId()}"
			) );
		}
	}

	/**
	 * hook: ArticleSaveComplete
	 */
	public static function purgeArticleContribs( &$article, &$user, $text,
		$summary, $minoredit, $watchthis, $sectionanchor, &$flags, $revision,
		&$status, $baseRevId
	)
	{
		if ( count( $status->errors ) == 0 ) {
			AttributionCache::getInstance()->purge( $article->getTitle(), $user );
		}
		return true;
	}

	/**
	 * hook: TitleMoveComplete
	 */
	public static function purgeArticleContribsAfterMove( $oldTitle, $newTitle, $user ) {
		AttributionCache::getInstance()->purge( $oldTitle, $user );
		//AttributionCache::getInstance()->purge( $newTitle, $user );
		return true;
	}

	function getFirstContributor( $pageTitleId ) {
		global $wgMemc;

		$key = wfMemcKey( 'first_contributor', $pageTitleId, 3 );
		$data = $wgMemc->get( $key );

		$num1 = array();
		if ( empty( $data ) ) {
			wfDebug( "Loading first contributor for {$pageTitleId} from DB\n" );
			$dbr = wfGetDB( DB_SLAVE );

			$s = $dbr->selectRow(
				'revision',
				array( 'rev_user', 'rev_user_text' ),
				array( 'rev_page' => $pageTitleId ),
				__METHOD__,
				array( 'ORDER BY' => 'rev_id ASC', 'LIMIT' => 1 )
			);
			// set to 1 if anon, as only one person can actually "ask" the question..
			$editsNum = !empty( $s->rev_user ) ? $this->getUserEditPoints( $s->rev_user ) : 1;
			$num1 = $this->getContribsEntry(
				$s->rev_user,
				$editsNum,
				$s->rev_user_text
			);
			$wgMemc->set( $key, $num1, 60 * 60 );
		} else {
			wfDebug( "Loading first contributor for page {$pageTitleId} from cache\n" );
			$num1 = $data;
		}

		return $num1;
	}

}