<?php

//namespace JasonGrimes;

class  ABCFSL_Paginator
{
    const NUM_PLACEHOLDER = '(:num)';

    protected $totalItems;
    protected $numPages;
    protected $itemsPerPage;
    protected $currentPage;
    protected $urlPattern;
    protected $pgsToShow = 10;
    protected $pgnationSize = 'SM';
    protected $justify = 'R';
    protected $activeBkgColor = 'B';
    protected $clsPfix;


    /**
     * @param string $urlPattern A URL for each page, with (:num) as a placeholder for the page number. Ex. '/foo/page/(:num)'
     */
    public function __construct( $par ) {

        $this->clsPfix = $par['clsPfix'];

        $this->totalItems = $par['totalQty'];
        $this->itemsPerPage = $par['pgQty'];
        $this->urlPattern = $par['urlPattern'];
        $this->justify = $this->clsPfix . 'Justify_' . $par['justify'];
        $this->pgnationSize = $this->clsPfix . 'Pagination_' . $par['pgnationSize'];
        $this->activeBkgColor = $this->clsPfix . 'PageLink_' . $par['pgnationColor'];

        $this->updateNumPages();
        $this->setCurrentPage( $par['currentPage'] );
        $this->setMaxPagesToShow( $par['pgsToShow'] );
    }

    public function __toString() {
        return $this->toHtml();
    }

    //==================================================
    public function toHtml() {

        if ( $this->numPages <= 1 ) {  return ''; }

        $ulCls = trim( $this->clsPfix . 'Pagination ' . $this->pgnationSize . ' ' . $this->justify );

        $html = '<nav><ul class="' . $ulCls . '">';
        $html .= $this->html_prev();
        $html .= $this->html_pgs();
        $html .= $this->html_next();
        $html .= '</ul></nav>';

        return $html;
    }

    public function html_prev(){

        $html = '';
        if ( $this->getPrevUrl() ) {

            $html .= '<li class="' . $this->clsPfix . 'PageItem">' .
                '<a class="' . $this->clsPfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $this->getPrevUrl() . '" aria-label="Previous">' .
                '<span aria-hidden="true">&laquo;</span>' .
                '<span class="sr-only">Previous</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_next(){

        $html = '';
        if ( $this->getNextUrl() ) {

            $html .= '<li class="' . $this->clsPfix . 'PageItem">' .
                '<a class="' . $this->clsPfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $this->getNextUrl() . '" aria-label="Previous">' .
                '<span aria-hidden="true">&raquo;</span>' .
                '<span class="sr-only">Next</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_pgs(){

        $html = '';

        foreach ( $this->getPages() as $page ) {

            if ( $page['isCurrent']  ) {
                $html .= '<li class="' . $this->clsPfix . 'PageItem ' . $this->clsPfix . 'Active">' .
                            '<a class="' . $this->clsPfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $page['url'] . '">' . $page['num'] . '<span class="sr-only">(current)</span></a>' .
                        '</li>';
            }
            else {

        if ($page['url']) {
                $html .= '<li class="' . $this->clsPfix . 'PageItem">' .
                            '<a class="' . $this->clsPfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $page['url'] . '">' . $page['num'] . '</a>' .
                        '</li>';
            } else {
                $html .= '<li class="' . $this->clsPfix . 'PageItem ' . $this->clsPfix . 'DisabledDisabled"><span class="' . $this->clsPfix . 'PageLink ' . $this->activeBkgColor . '">' . $page['num'] . '</span></li>';
        }
            }
        }
        return $html;
    }

    //===================================================

    protected function setCurrentPage( $currentPage ) {

        if( empty( $currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( !is_numeric( $currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( !ctype_digit( (string)$currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( $currentPage > $this->numPages ){
             $this->currentPage = 1;
             return;
        }

        $this->currentPage = $currentPage;
    }

    protected function updateNumPages() {
        $this->numPages = ($this->itemsPerPage == 0 ? 0 : (int) ceil($this->totalItems/$this->itemsPerPage));
    }
    //----------------------------------------

    //----------------------------------------

    public function setMaxPagesToShow( $pgsToShow ) {
        if ($pgsToShow < 3) { $pgsToShow = 3; }
        $this->pgsToShow = $pgsToShow;
    }

    public function getPageUrl( $pageNum ) {
        return str_replace(self::NUM_PLACEHOLDER, $pageNum, $this->urlPattern);
    }

    public function getNextPage() {
        if ($this->currentPage < $this->numPages) {
            return $this->currentPage + 1;
        }
        return null;
    }

    public function getPrevPage()
    {
        if ($this->currentPage > 1) {
            return $this->currentPage - 1;
        }

        return null;
    }

    public function getNextUrl()    {
        if (!$this->getNextPage()) {
            return null;
        }
        return $this->getPageUrl( $this->getNextPage() );
    }

    public function getPrevUrl()  {

        if (!$this->getPrevPage()) { return null; }
        return $this->getPageUrl( $this->getPrevPage() );

    }

    /**
     * Get an array of paginated page data.
     *
     * Example:
     * array(
     *     array ('num' => 1,     'url' => '/example/page/1',  'isCurrent' => false),
     *     array ('num' => '...', 'url' => NULL,               'isCurrent' => false),
     *     array ('num' => 3,     'url' => '/example/page/3',  'isCurrent' => false),
     *     array ('num' => 4,     'url' => '/example/page/4',  'isCurrent' => true ),
     *     array ('num' => 5,     'url' => '/example/page/5',  'isCurrent' => false),
     *     array ('num' => '...', 'url' => NULL,               'isCurrent' => false),
     *     array ('num' => 10,    'url' => '/example/page/10', 'isCurrent' => false),
     * )
     *
     * @return array
     */
    public function getPages()
    {
        $pages = array();

        if ($this->numPages <= 1) {
            return array();
        }

        if ($this->numPages <= $this->pgsToShow) {
            for ($i = 1; $i <= $this->numPages; $i++) {
                $pages[] = $this->createPage( $i, $i == $this->currentPage);
            }
        } else {

            // Determine the sliding range, centered around the current page.
            $numAdjacents = (int) floor(($this->pgsToShow - 3) / 2);

            if ($this->currentPage + $numAdjacents > $this->numPages) {
                $slidingStart = $this->numPages - $this->pgsToShow + 2;
            } else {
                $slidingStart = $this->currentPage - $numAdjacents;
            }

            if ($slidingStart < 2) { $slidingStart = 2; }

            $slidingEnd = $slidingStart + $this->pgsToShow - 3;
            if ($slidingEnd >= $this->numPages) { $slidingEnd = $this->numPages - 1; }

            // Build the list of pages.
            $pages[] = $this->createPage(1, $this->currentPage == 1);
            if ($slidingStart > 2) {
                $pages[] = $this->createPageEllipsis();
            }
            for ($i = $slidingStart; $i <= $slidingEnd; $i++) {
                $pages[] = $this->createPage($i, $i == $this->currentPage);
            }
            if ($slidingEnd < $this->numPages - 1) {
                $pages[] = $this->createPageEllipsis();
            }
            $pages[] = $this->createPage($this->numPages, $this->currentPage == $this->numPages);
        }

        return $pages;
    }

        /**
     * Create a page data structure.
     *
     * @param int $pageNum
     * @param bool $isCurrent
     * @return Array
     */
    protected function createPage( $pageNum, $isCurrent = false )
    {
        return array(
            'num' => $pageNum,
            'url' => $this->getPageUrl($pageNum),
            'isCurrent' => $isCurrent,
        );
    }

    /**
     * @return array
     */
    protected function createPageEllipsis()
    {
        return array(
            'num' => '...',
            'url' => null,
            'isCurrent' => false,
        );
    }
}