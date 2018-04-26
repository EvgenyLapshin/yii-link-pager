<?php

/**
 * Class LinkPager
 *
 * @author Evgeny Lapshin <hello@evgenylapshin.ru>
 * @link http://evgenylapshin.ru
 */
class LinkPager extends CBasePager
{
    public $view = 'index';
    public $itemView = 'item';
    public $currentView = 'current';
    public $prevView = 'prev';
    public $nextView = 'next';
    public $firstView = '';
    public $lastView = '';

    public $itemHtmlOption = array();

    /**
     * @var integer maximum number of page buttons that can be displayed. Defaults to 10.
     */
    public $maxButtonCount = 10;

    /**
     * @throws CException
     */
    public function run()
    {
        $this->generatePager();
    }

    /**
     * @throws CException
     */
    protected function generatePager()
    {
        if (($pageCount = $this->getPageCount()) <= 1) {
            return;
        }

        list($beginPage, $endPage) = $this->getPageRange();
        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $pager = array();

        // first page
        if ($this->firstView) {
            $pager['first'] = $this->renderPage(0, $this->firstView);
        }

        // prev page
        if ($this->prevView) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $pager['prev'] = $this->renderPage($page, $this->prevView);
        }

        // internal pages
        $items = '';
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $items .= ($i == $currentPage)
                ? $this->renderPage($i, $this->currentView)
                : $this->renderPage($i, $this->itemView);
        }
        $pager['items'] = $items;

        // next page
        if ($this->nextView) {
            if (($page = $currentPage + 1) > $pageCount) {
                $page = 0;
            }
            $pager['next'] = $this->renderPage($page, $this->nextView);
        }

        // last page
        if ($this->lastView) {
            $pager['last'] = $this->renderPage($pageCount - 1, $this->lastView);
        }

        $this->render($this->view, $pager);
    }

    /**
     * Creates a page button.
     * You may override this method to customize the page buttons.
     * @param integer $page the page number
     * @param string $view
     * @return string the generated button
     * @throws CException
     */
    protected function renderPage($page, $view)
    {
        return $this->render($view, array(
            'page' => $page,
            'url' => $this->createPageUrl($page - 1)
        ), true);
    }

    /**
     * @return array the begin and end pages that need to be displayed.
     * @author Qiang Xue <qiang.xue@gmail.com>
     */
    protected function getPageRange()
    {
        $currentPage = $this->getCurrentPage();
        $pageCount = $this->getPageCount();

        $beginPage = max(1, $currentPage - (int)($this->maxButtonCount / 2));
        if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount;
            $beginPage = max(1, $endPage - $this->maxButtonCount + 1);
        }
        return array($beginPage, $endPage);
    }
}