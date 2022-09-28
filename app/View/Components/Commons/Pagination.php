<?php

namespace App\View\Components\Commons;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $posts;


    /**
     * Create a new component instance.
     *
     * @param   $posts
     * @return void
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.commons.pagination');
    }
}
