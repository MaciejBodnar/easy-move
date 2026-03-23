<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use App\View\Composers\Main;
use App\View\Composers\About;
use App\View\Composers\ServiceList;
use App\View\Composers\Service;
use App\View\Composers\Post;
use App\View\Composers\Contact;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->app->make('view')
            ->composer(['front-page', 'front-page.blade.php'], Main::class)
            ->composer(['about-template', 'about-template.blade.php'], About::class)
            ->composer(['service-list-template', 'service-list-template.blade.php'], ServiceList::class)
            ->composer(['service-template', 'service-template.blade.php'], Service::class)
            ->composer(['single-post', 'single-post.blade.php'], Post::class)
            ->composer(['contact-template', 'contact-template.blade.php'], Contact::class);
    }
}
