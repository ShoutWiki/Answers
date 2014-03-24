<?php
/**
 * ApiQueryMostCategories - get list of the categories with the most pages
 *
 * @file
 * @ingroup API
 * @author David Pean <david.pean@gmail.com>
 */

class ApiQueryMostCategories extends ApiQueryBase {
    /**
     * Constructor
     */
	public function __construct( $query, $moduleName ) {
		parent::__construct( $query, $moduleName, 'wk' );
	}

    /**
     * Initial parameters (copypasted from extensions/wikia/WikiaApi/WikiaApiQuery.php)
     */
	protected function getInitialParams() {
		$initialParams = $this->getAllowedParams();
		$requestParams = $this->extractRequestParams();
		foreach ( $initialParams as $param => $value ) {
			if ( isset( $requestParams[$param] ) ) {
				$initialParams[$param] = $requestParams[$param];
			} else {
				$initialParams[$param] = null;
			}
		}
		return $initialParams;
	}

    /**
     * Main function
     */
	public function execute() {
		$this->getPagesByCategory();
	}

	private function getPagesByCategory() {
		global $wgDBname;

        // initial parameters (dbname, limit, offset ...)
		extract( $this->getInitialParams() );

        // request parameters ()
		extract( $this->extractRequestParams() );

		$this->initCacheKey( $lcache_key, __METHOD__ );

		try {
			// database instance
			$db = $this->getDB();
			$db->selectDB( $wgDBname );

			if ( is_null( $db ) ) {
				$this->dieUsage( 'Database error -- no database handler', 'invaliddboject' );
			}

			$this->addTables( array( 'categorylinks' ) );
			$this->addFields( array(
				'cl_to',
				'COUNT(*) AS cnt'
			));

			// limit
			if ( !empty( $limit ) ) {
				if ( intval( $limit ) !== $limit ) {
					$this->dieUsage( 'Invalid limit parameter', 'invalidlimit' );
				}
				$this->addOption( 'LIMIT', $limit );
				$this->setCacheKey( $lcache_key, 'L', $limit );
			}

			// offset
			if ( !empty( $offset ) ) {
				if ( intval( $offset ) !== $offset ) {
					$this->dieUsage( 'Invalid offset parameter', 'invalidoffset' );
				}
				$this->addOption( 'OFFSET', $offset );
				$this->setCacheKey( $lcache_key, 'LO', $limit );
			}

			// order by
			$this->addOption( 'ORDER BY', 'cnt DESC' );
			// group by
			$this->addOption( 'GROUP BY', 'cl_to' );

			$data = array();
			// check data from cache ...
			$cached = $this->getDataFromCache( $lcache_key );
			if ( !is_array( $cached ) ) {
				$res = $this->select( __METHOD__ );
				foreach ( $res as $row ) {
					$data[$row->cl_to] = array(
						'count' => $row->cnt,
						'url' => Title::makeTitle( NS_CATEGORY, $row->cl_to )->escapeFullURL()
					);
					ApiResult::setContent( $data[$row->cl_to], $row->cl_to );
				}
				$this->saveCacheData( $lcache_key, $data, $ctime );
			} else {
				// ... cached
				$data = $cached;
			}
		} catch ( DBQueryError $e ) {
			$e = 'Query error: ' . $e->getText();
		} catch ( DBConnectionError $e ) {
			$e = 'DB connection error: ' . $e->getText();
		} catch ( DBError $e ) {
			$e = 'Error in database: ' . $e->getLogMessage();
		}

		// is exception
		if ( isset( $e ) ) {
			$data = $e;//$e->getText();
			$this->getResult()->setIndexedTagName( $data, 'fault' );
		} else {
			$this->getResult()->setIndexedTagName( $data, 'item' );
		}

		$this->getResult()->addValue( 'query', $this->getModuleName(), $data );
	}

	/**
	 * Description's functions
	 */
	protected function getDescription() {
		return 'Get wiki pages by category';
	}

	/**
	 * Description's parameters
	 */
	protected function getParamDescription() {
		return array(
			'category' => 'category to get pages for',
		);
	}

	/**
	 * Allowed parameters
	 */
	protected function getAllowedParams() {
		return array(
			'limit' => array( ApiBase::PARAM_TYPE => 'integer' )
		);
	}

	/**
	 * Examples
	 */
	protected function getExamples() {
		return array(
			'api.php?action=query&list=wkmostcat',
			'api.php?action=query&list=wkmostcat&wklimit=5',
		);
	}

	/**
	 * Version
	 */
	public function getVersion() {
		return __CLASS__ . ': $Id: ' . __CLASS__ . '.php ' .
			filesize( dirname( __FILE__ ) . '/' . __CLASS__ . '.php' ) . ' ' .
			strftime( '%Y-%m-%d %H:%M:%S', time() ) . 'Z $';
	}
}