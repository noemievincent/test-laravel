<?php

namespace App\View\Components\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\Component;
use Ramsey\Collection\Collection;

class SelectCategories extends Component
{
    public $categories;
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->categories = Category::all();
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posts.select-categories');
    }
}
