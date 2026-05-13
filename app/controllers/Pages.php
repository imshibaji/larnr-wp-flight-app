<?php
namespace App\Controllers;

use flight\Engine;

class Pages extends Controller {
    protected Engine $app;

    public function __construct($app) {
        parent::__construct($app);
        // get the mentors
        $this->wpApi->registerCustomPostType('Mentors', 'wp/v2/mentors');
        $this->wpApi->registerCustomPostType('Addresses', 'app/v1/addresses');
    }
    
    public function home() {
        $page = $this->filtered($this->wpApi->getPages(), 'larnr-the-ultimate-educations-for-career-building');

        $this->app->render('fronts/home', [
            'page' => $page
        ]);
    }

    public function mentors() {
        $cache = $this->wpApi->getPages(true);
        $allPages = $cache->data;
        $lastUpdated = $cache->created_at;

        $page = $this->filtered($allPages, 'mentors');
        $mentors = $this->wpApi->getMentors();

        // map the mentors
        $mentors = array_map(function($mentor) {
            $mentor->addr = $this->wpApi->getAddress($mentor->address[0]->id);
            $mentor->image = $this->wpApi->getMedia($mentor->featured_media);
            return $mentor;
        }, $mentors);

        // dd($mentors);
        $this->app->render('fronts/mentors', [
            'page' => $page,
            'mentors' => $mentors,
            'updated_at' => date('H:i:s', $lastUpdated), // Format: 14:30:05
            'is_cached' => (time() - $lastUpdated) > 1 // True if data is older than 1 second
        ]);
    }

    public function mentor($slug) {
        $cache = $this->wpApi->getMentor(true);
        $allPages = $cache->data;
        $lastUpdated = $cache->created_at;

        $page = $this->filtered($allPages, $slug);

        $this->app->render('fronts/mentor', [
            'page' => $page,
            'updated_at' => date('H:i:s', $lastUpdated), // Format: 14:30:05
            'is_cached' => (time() - $lastUpdated) > 1 // True if data is older than 1 second
        ]);
    }

    public function page($slug) {
        $cache = $this->wpApi->getPages(true);
        $allPages = $cache->data;
        $lastUpdated = $cache->created_at;

        $page = $this->filtered($allPages, $slug);

        $this->app->render('fronts/page', [
            'page' => $page,
            'updated_at' => date('H:i:s', $lastUpdated), // Format: 14:30:05
            'is_cached' => (time() - $lastUpdated) > 1 // True if data is older than 1 second
        ]);
    }
}