<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SiteComposer
{
    protected $site;
    protected $navbar;
    /**
     * Create a new site composer.
     *
     * @param $site
     * @return void
     */
    public function __construct()
    {
        $site = new \stdClass();
        $site->email = 'test@test.com';
        $site->twitter_username = 'test@test.com';
        $site->facebook_username = 'test@test.com';
        $site->linkedin_username = 'test@test.com';

        $this->site = $site;

        // $navbar = new \stdClass();

        // $navbar->routes->home About
        // $navbar->routes->about About 
        // $navbar->routes->memorial-garden Memorial Garden 
        // $navbar->routes->news News 
        // $navbar->routes->lottery Lottery 
        // $navbar->routes->shop Shop 
        // $navbar->routes->contact Contact 
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('site', $this->site);
    }
}