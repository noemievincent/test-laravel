<?php

namespace App\View\Components\Commons;

use App\Models\User;
use Illuminate\View\Component;

class Navigation extends Component
{
    public User $author;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author = User::where('email', 'noemie.vincent1@student.hepl.be')->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.commons.navigation');
    }
}
