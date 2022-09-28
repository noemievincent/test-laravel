<?php

namespace App\View\Components\Aside;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Categories extends Component
{

    public Collection $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::withCount('posts')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.categories');
    }
}
