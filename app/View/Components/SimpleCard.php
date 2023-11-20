<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimpleCard extends Component
{
    public $imageUrl = '';
    public $title;
    public $subtitle = '';
    public $route = '';

    /**
     * Create a new component instance.
     *
     * @param string|null $imageUrl 
     * @param string $title
     * @param string|null $subtitle
     * @param string|null $route 
     */
    public function __construct(
        $imageUrl = null,
        $title,
        $subtitle = null,
        $route = null
    ) {
        $this->imageUrl = $imageUrl ?? 'https://via.placeholder.com/640x480.png/00ff77?text=No+Image';
        $this->title = $title;
        $this->subtitle = $subtitle ?? '';
        $this->route = $route ?? '/';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.simple-card');
    }
}
