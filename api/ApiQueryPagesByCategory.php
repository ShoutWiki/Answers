<?php
/**
 * ApiQueryPagesByCategory - get list of popular pages for selected namespace
 *
 * @file
 * @ingroup API
 * @author David Pean <david.pean@gmail.com>
 */

class ApiQueryPagesByCategory extends ApiQueryBase {
	public function __construct( $query, $moduleName ) {
		parent::__construct( $query, $moduleName, 'wk' );
	}

	public function execute() {
		$this->getPagesByCategory();
	}

	protected function getDB() {
		global $wgDBname;
		return wfGetDB( DB_SLAVE, array(), $wgDBname );
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

	public function initCacheKey( &$key, $initParam, $value = '' ) {
		global $wgDBname;
		$key = $wgDBname . ':' . $initParam;
		if ( !empty( $value ) ) {
			$key .= ':' . $value;
		}
	}

	public function setCacheKey( &$key, $prefix, $value ) {
		$prefix = ( empty( $prefix ) ) ? '' : $prefix . ':';
		$prefix .= $value;
		$key .= '::' . $prefix;
	}

	public function saveCacheData( $key, $data, $time = 900 /* 5 * 60 * 3 */ ) {
		global $wgMemc;
		$wgMemc->set( md5( $key ), $data, $time );
		return true;
	}

	/**
	 * If someone wants to use it
	 */
	private function getPagesByCategoryWithOffset() {
		global $wgDBname;

		// blank variables
		$category = $order = null;

		// initial parameters (dbname, limit, offset ...)
		extract( $this->getInitialParams() );

		// request parameters ()
		extract( $this->extractRequestParams() );

		$this->initCacheKey( $lcache_key, __METHOD__ );

		try {
			// database instance
			$db = $this->getDB();
			if ( is_null( $db ) ) {
				$this->dieUsage( 'Database error -- no database handler', 'invaliddboject' );
			}

			// check categories
			$cats = explode( '|', $category );
			$encodedCats = array();
			$memcKeyCats = '';
			foreach ( $cats as $cat ) {
				$categoryTitle = Title::newFromText( $cat );
				if ( is_object( $categoryTitle ) ) {
					$encodedCats[] = $db->strencode( $categoryTitle->getDBkey() );
					$memcKeyCats .= str_replace( ' ', '_', $categoryTitle->getDBkey() );
				}
			}

			if ( empty( $encodedCats ) ) {
				$this->dieUsage( 'The category name is missing', 'missingcategory' );
			}
			$this->setCacheKey( $lcache_key, 'CCX', $memcKeyCats );

			# check order by to use proper table from DB
			$orderCache = 0;
			if ( !empty( $order ) ) {
				switch ( $order ) {
					case 'edit':
						$order_field = 'page.page_touched DESC';
						$orderCache = 1;
						break;
					case 'random':
						$orderCache = wfRandom();
						$this->addWhere( 'page_random >= ' . $orderCache );
						$order_field = 'page.page_random';
						break;
					default :
						$order_field = 'page.page_id DESC';
						break;
				}
			} elseif ( count( $encodedCats ) > 1 ) {
				$order_field = 'categorylinks.cl_to, categorylinks.cl_from DESC';
				$orderCache = 3;
			} else {
				$order_field = 'page.page_id DESC';
				$orderCache = 4;
			}
			$this->setCacheKey( $lcache_key, 'ORD', $orderCache );

			# if user categorylinks in query
			$useCategoryLinks = 0;
			if ( strpos( $order_field, 'categorylinks' ) !== false ) {
				$useCategoryLinks = 1;
			}

			if ( !empty( $useCategoryLinks ) ) {
				# build main query on categorylinks table
				$this->addTables( array( 'categorylinks' ) );
				$this->addFields( array(
					'cl_from as page_id',
					'cl_to'
				));
				$this->addWhere( "cl_to IN ('" . implode( "','", $encodedCats ) . "')" );
			} else {
				# build main query on page table
				$this->addTables( array( 'page' ) );
				$this->addFields( array(
					'page_id',
					'page_namespace',
					'page_title',
					'page_touched',
					'page_random'
				));
				$this->addWhere( "page_id IN (SELECT DISTINCT(cl_from) FROM `categorylinks` WHERE cl_to IN ('" . implode( "','", $encodedCats ) . "'))" );
				$this->addWhere( 'page_is_redirect = 0' );
			}

			$this->addOption( 'ORDER BY', $order_field );

			// limit
			if ( !empty( $limit ) ) {
				if ( intval( $limit ) !== $limit ) {
					$this->dieUsage( 'Invalid limit', 'invalidlimit' );
				}
				$this->addOption( 'LIMIT', $limit );
				$this->setCacheKey( $lcache_key, 'L', $limit );
			}

			if ( !empty( $offset )  ) {
				if ( intval( $offset ) !== $offset ) {
					$this->dieUsage( 'Invalid offset', 'invalidoffset' );
				}
				$this->addOption( 'OFFSET', $offset );
				$this->setCacheKey( $lcache_key, 'LO', $limit );
			}

			$data = array();
			// check data from cache...
			$cached = ''; #$this->getDataFromCache( $lcache_key );
			if ( !is_array( $cached ) ) {
				$res = $this->select( __METHOD__ );
				foreach ( $res as $row ) {
					if ( !empty( $useCategoryLinks ) ) {
						# for categorylinks table
						$title = Title::newFromID( $row->page_id );
						if ( $title instanceof Title ) {
							$data[$row->page_id] = array(
								'id'			=> $row->page_id,
								'category'		=> $row->cl_to,
								'namespace' 	=> $title->getNamespace(),
								'title' 		=> $title->getText(),
								'url' 			=> $title->escapeFullURL()
							);
						}
					} else {
						// for page table
						$data[$row->page_id] = array(
							'id'			=> $row->page_id,
							'namespace'		=> $row->page_namespace,
							'title'			=> $row->page_title,
							'url'			=> Title::makeTitle( $row->page_namespace, $row->page_title )->escapeFullURL()
						);
					}
				}

				// get rest values
				if ( !empty( $data ) ) {
					$aPages = implode( ',', array_keys( $data ) );
					$this->resetQueryParams();
					if ( empty( $useCategoryLinks ) ) {
						$this->addTables( array( 'categorylinks' ) );
						$this->addFields( array(
							'cl_from AS page_id',
							'cl_to'
						));
						$this->addWhere( 'cl_from IN (' . $aPages . ')' );
						$this->addWhere( "cl_to IN ('". implode( "','", $encodedCats ) . "')" );

						$res = $this->select( __METHOD__ );
						foreach ( $res as $row ) {
							$data[$row->page_id]['category'] = $row->cl_to;
						}
					}

					// set content
					foreach ( $data as $page_id => $values ) {
						ApiResult::setContent( $values, $values['title'] );
					}

					// set in memcached
					$this->saveCacheData( $lcache_key, $data, $ctime );
				}
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

	private function getPagesByCategory() {
		global $wgDBname;

		// blank variables
		$category = $order = null;

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

			// check categories
			$cats = explode( '|', $category );
			$encodedCats = array();
			$memcKeyCats = '';
			foreach ( $cats as $cat ) {
				$categoryTitle = Title::newFromText( $cat );
				if ( is_object( $categoryTitle ) ) {
					$encodedCats[] = $db->strencode( $categoryTitle->getDBkey() );
					$memcKeyCats .= str_replace( ' ', '_', $categoryTitle->getDBkey() );
				}
			}

			if ( empty( $encodedCats ) ) {
				$this->dieUsage( 'Missing category parameter', 'missingcategory' );
			}

			$this->setCacheKey( $lcache_key, 'CCX', $memcKeyCats );

			# check order by to use proper table from DB
			$orderCache = 0;
			if ( !empty( $order ) ) {
				switch ( $order ) {
					case 'edit':
						$order_field = 'page.page_touched DESC';
						$orderCache = 1;
						break;
					case 'random':
						$orderCache = wfRandom();
						$this->addWhere( 'page_random >= ' . $orderCache );
						$order_field = 'page.page_random';
						break;
					default:
						$order_field = 'page.page_id DESC';
						break;
				}
			} elseif ( count( $encodedCats ) > 1 ) {
				$order_field = 'page.page_id DESC'; #'categorylinks.cl_to, categorylinks.cl_from DESC';
				$orderCache = 3;
			} else {
				$order_field = 'page.page_id DESC';
				$orderCache = 4;
			}
			$this->setCacheKey( $lcache_key, 'ORD', $orderCache );

			// limit
			if ( !empty( $limit ) ) {
				if ( intval( $limit ) !== $limit ) {
					$this->dieUsage( 'Invalid limit parameter', 'invalidlimit' );
				}
				$this->setCacheKey( $lcache_key, 'L', $limit );
			} else {
				// Define the damn variable...
				$limit = 0;
			}

			if ( !empty( $offset ) ) {
				if ( intval( $offset ) !== $offset ) {
					$this->dieUsage( 'Invalid offset parameter', 'invalidoffset' );
				}
				$this->setCacheKey( $lcache_key, 'LO', $offset );
			}

			# if user categorylinks in query
			sort( $encodedCats );
			$data = array();
			// check data from cache ...
			$cached = ''; #$this->getDataFromCache( $lcache_key );
			if ( !is_array( $cached ) ) {
				foreach ( $encodedCats as $id => $category ) {
					$pages = $this->getCategoryPages( $db, $category, $limit );
					// no pages
					if ( empty( $pages ) ) {
						continue;
					}

					$this->resetQueryParams();
					# build main query on page table
					$this->addTables( array( 'page' ) );
					$this->addFields( array(
						'page_id',
						'page_namespace',
						'page_title',
						'page_touched',
						'page_random'
					));
					$this->addWhere( "page_id IN ('" . implode( "','", $pages ) . "')" );
					$this->addWhere( 'page_is_redirect = 0' );
					$this->addOption( 'LIMIT', $limit );
					$this->addOption( 'OFFSET', $offset );
					$this->addOption( 'ORDER BY', $order_field );
					$res = $this->select( __METHOD__ );
					foreach ( $res as $row ) {
						$data[$row->page_id] = array(
							'id'			=> $row->page_id,
							'namespace'		=> $row->page_namespace,
							'title'			=> $row->page_title,
							'url'			=> Title::makeTitle( $row->page_namespace, $row->page_title )->escapeFullURL(),
							'category'		=> $category
						);
						ApiResult::setContent( $data[$row->page_id], $row->page_title );
					}

					if ( count( $data ) >= $limit ) {
						break;
					}
				}
				// set in memcached
				$this->saveCacheData( $lcache_key, $data/*, $ctime*/ );
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

	private function getCategoryPages( $db, $category, $limit ) {
		$this->resetQueryParams();

		// build main query on page table
		$this->addTables( array( 'categorylinks' ) );
		$this->addFields( array( 'cl_from AS page_id' ) );
		$this->addWhere( array( 'cl_to' => $category ) );
		$this->addOption( 'ORDER BY', 'rand()' );
		$this->addOption( 'LIMIT', $limit * 2 );

		$res = $this->select( __METHOD__ );

		$pages = array();
		foreach ( $res as $row ) {
			$pages[] = $row->page_id;
		}

		return $pages;
	}

	protected function getDescription() {
		return 'Get wiki pages by category';
	}

	protected function getParamDescription() {
		return array(
			'category' => 'category to get pages for'
		);
	}

	protected function getAllowedParams() {
		return array(
			'category' => array( ApiBase::PARAM_TYPE => 'string' ),
			'order' => array( ApiBase::PARAM_TYPE => 'string' )
		);
	}

	protected function getExamples() {
		return array(
			'api.php?action=query&list=wkpagesincat',
			'api.php?action=query&list=wkpagesincat&wkcategory=fun'
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id: ' . __CLASS__ . '.php ' .
			filesize( dirname( __FILE__ ) . '/' . __CLASS__ . '.php' ) . ' ' .
			strftime( '%Y-%m-%d %H:%M:%S', time() ) . 'Z $';
	}
}