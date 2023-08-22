<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieItem extends Component
{
    public $title;
    public $favorited;

    public function __construct($title, $favorited)
    {
        $this->title = $title;
        $this->favorited = $favorited;
    }

    public function render()
    {
        return view('components.movie-item');
    }
}
