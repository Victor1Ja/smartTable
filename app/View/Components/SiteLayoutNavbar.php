<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SiteLayoutNavbar extends Component
{
    public array $menu_items;
    public array $home_menu_items;
    public array $admin_menu_items;

    public function __construct()
    {
        $this->menu_items = [
            ['label' => 'Welcome', 'route' => 'welcome', 'url' => null,],
            ['label' => 'Restaurants', 'route' => 'restaurants.index', 'url' => null,],
            ['label' => 'About', 'route' => 'welcome', 'url' => null,],
            ['label' => 'Contact', 'route' => 'welcome', 'url' => null,],
        ];
        $this->home_menu_items = [];

        $this->admin_menu_items = [];
    }

    public function render(): View|Closure|string
    {
        return view('layout.site-layout-navbar');
    }
}
