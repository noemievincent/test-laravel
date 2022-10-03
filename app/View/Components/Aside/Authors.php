<?php

namespace App\View\Components\Aside;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Authors extends Component
{
    public Collection $authors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (request()->has('authors-expanded')) {
            $this->authors = User::withCount(['posts'])->get();
        } else {
            $this->authors = User::withCount(['posts'])->take(5)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.authors');
    }
}