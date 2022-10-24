<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class SortOrder extends Component
{
    public $options;
    public $option;
    public $orderBy;

    public function mount()
    {
        $this->options = [
            'newest' => 'DESC',
            'oldest' => 'ASC'];
    }

    public function updatedOrderBy()
    {
        $this->emit('orderByUpdated', $this->orderBy);
    }

    public function render()
    {
        return view('livewire.posts.sort-order');
    }
}
