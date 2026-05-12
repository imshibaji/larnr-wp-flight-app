<?php
namespace App\Controllers;

use flight\Engine;
use App\Utils\WpApi;

abstract class Controller {
    protected Engine $app;
    protected WpApi $wpApi;
    
    public function __construct($app) {
        $this->app = $app;
        $this->wpApi = WpApi::init();
        begin_session();
    }

    protected function pageWithSeo($slug) {
        $page = WpApi::getPageBySlug($slug);

        if (isset($page->slug) === false) {
            $this->app->notFound(); // FlightPHP way to handle 404
            die();
        }

        // 2. Fetch SEO data using the absolute link from the WP object
        // WP REST API returns the absolute URL in $page->link
        $seoData = WpApi::getRankMathData($page->link);

        // 3. Merge the data. Rank Math returns { "head": "..." }
        $page->seoHead = $seoData->head ?? ''; 

        return $page;
    }

    protected function filtered($dataset, $slug) {
        // 1. Ensure dataset is an array to avoid crashes
        if (!is_array($dataset)) return null;

        $filtered = array_filter($dataset, fn($p) => ($p->slug ?? '') === $slug);
        $page = array_shift($filtered);

        if (isset($page->slug) === false) {
            $this->app->notFound(); // FlightPHP way to handle 404
            die();
        }

        // 2. Fetch SEO data using the absolute link from the WP object
        // WP REST API returns the absolute URL in $page->link
        $seoData = WpApi::init()->getRankMathData($page->link);

        // 3. Merge the data. Rank Math returns { "head": "..." }
        $page->seoHead = $seoData->head ?? ''; 

        return $page;
    }
}