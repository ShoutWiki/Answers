<?php

class CategoryWithAds extends CategoryViewer {

	function __construct( $title, $from = '', $until = '', $query = array() ) {
		parent::__construct( $title, RequestContext::getMain(), array( $from ), array( $until ), $query );
		$this->from = $from;
		$this->until = $until;
	}

	function doCategoryQuery() {
		$dbr = wfGetDB( DB_SLAVE, 'category' );
		if ( $this->from != '' ) {
			$pageCondition = 'cl_sortkey >= ' . $dbr->addQuotes( $this->from );
			$this->flip = false;
		} elseif ( $this->until != '' ) {
			$pageCondition = 'cl_sortkey < ' . $dbr->addQuotes( $this->until );
			$this->flip = true;
		} else {
			$pageCondition = '1 = 1';
			$this->flip = false;
		}
		$res = $dbr->select(
			array( 'page', 'categorylinks', 'category' ),
			array(
				'page_title', 'page_namespace', 'page_len', 'page_is_redirect',
				'cl_sortkey', 'cat_id', 'cat_title', 'cat_subcats',
				'cat_pages', 'cat_files', 'cat_id IS NULL AS cat_id_null'
			),
			array( $pageCondition, 'cl_to' => $this->title->getDBkey() ),
			__METHOD__,
			array(
				'ORDER BY' => $this->flip ? 'cat_id_null ASC, cl_sortkey DESC' : 'cat_id_null ASC, cl_sortkey',
				'USE INDEX' => array( 'categorylinks' => 'cl_sortkey' ),
				'LIMIT' => $this->limit + 1
			),
			array(
				'categorylinks' => array( 'INNER JOIN', 'cl_from = page_id' ),
				'category' => array( 'LEFT JOIN', 'cat_title = page_title AND page_namespace = ' . NS_CATEGORY )
			)
		);

		$count = 0;
		$this->nextPage = null;
		foreach ( $res as $x ) {
			if ( ++$count > $this->limit ) {
				// We've reached the one extra which shows that there are
				// additional pages to be had. Stop here...
				$this->nextPage = $x->cl_sortkey;
				break;
			}

			$title = Title::makeTitle( $x->page_namespace, $x->page_title );

			if ( $title->getNamespace() == NS_CATEGORY ) {
				$cat = Category::newFromRow( $x, $title );
				$this->addSubcategoryObject( $cat, $x->cl_sortkey, $x->page_len );
			} elseif ( $this->showGallery && $title->getNamespace() == NS_FILE ) {
				$this->addImage( $title, $x->cl_sortkey, $x->page_len, $x->page_is_redirect );
			} else {
				if ( wfRunHooks( 'CategoryViewer::addPage', array( &$this, &$title, &$x ) ) ) {
					$this->addPage( $title, $x->cl_sortkey, $x->page_len, $x->page_is_redirect );
				}
			}
		}
	}
}