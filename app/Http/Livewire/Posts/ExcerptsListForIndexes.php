<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ExcerptsListForIndexes extends Component
{
    use WithPagination;

    public $title;
    protected $posts;
    public $perPage;
    public $sortOrder;

    protected $listeners = [
        'orderByUpdated' => 'updatePostsWithOrderBy',
    ];

    public function mount()
    {
        $this->perPage = 10;
        $this->sortOrder = 'DESC';
    }


    public function updatePostsWithOrderBy($order)
    {
        $this->sortOrder = $order;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.posts.excerpts-list-for-indexes', [
            'posts' => Post::query()->orderBy('published_at', $this->sortOrder)->paginate($this->perPage),
        ]);
    }
}
