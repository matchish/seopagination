<?php

namespace Matchish\SeoPagination;

use Illuminate\Pagination\Paginator;

class SeoPagination
{
    
    protected $paginator;

    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }
    public function getPrevLink()
    {
        $url = $this->getPrevUrl();
        if ($url) {
            return '<link rel="prev" href="' . \URL::to($url) . '">';
        }
    }

    public function getNextLink()
    {
        $url = $this->getNextUrl();
        if (isset($url)) {
            return '<link rel="next" href="' . \URL::to($url) . '">';
        }
    }

    public function getCanonicalMetaTag()
    {
        return '<link rel="canonical" href="' . \URL::to(\Request::path()) . '" />';
    }

    public function getYandexMetaTag()
    {
        $paginator = $this->paginator;
        if (empty($paginator)) {
            return null;
        }
        if ($paginator->currentPage() > 1) {
            return '<meta name="yandex" content="noindex, follow"/>';
        }
    }

    protected function getNextUrl()
    {
        $paginator = $this->paginator;
        if (empty($paginator)) {
            return null;
        }
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        if ($currentPage >= $lastPage) {
            return null;
        } else {
            return $paginator->url($currentPage + 1);
        }

    }

    protected function getPrevUrl()
    {
        $paginator = $this->paginator;
        if (empty($paginator)) {
            return null;
        }
        $currentPage = $paginator->currentPage();
        if ($currentPage <= 1) {
            return null;
        }
        $url = $paginator->url($currentPage - 1);
        if (preg_match('~(page\=1)$~', $url)) {
            $url = parse_url($url);
            parse_str($url['query'], $query);
            unset($query['page']);
            $query = http_build_query($query);
            $url = empty($query) ? $url['path'] : $url['path'] . '?' . $query;
        }
        return $url;
    }
}
