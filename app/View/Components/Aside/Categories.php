<?php

namespace App\View\Components\Aside;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Categories extends Component
{
    public Collection $categories;
    public int $categories_count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $query = Category::withCount('posts');
        $this->categories_count = Category::count();
        if (request()->has('aside-expanded') && request('aside-expanded') === 'categories') {
            $this->categories = $query->get();
        } else {
            $this->categories = $query->take(5)->get();
        }
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
