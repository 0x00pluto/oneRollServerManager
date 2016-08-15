<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\WebConfig;
use Config;
use Illuminate\Contracts\Foundation\Application;

class SideBarComposer
{
    protected $user;
    /**
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function compose(View $view)
    {
        $meuns = config('menus');
        $view->with('sidebarmenus', $meuns);
    }
}