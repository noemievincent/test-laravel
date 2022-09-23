<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

const DEFAULT_SORT_ORDER = 'DESC';
const PER_PAGE = 6;

class Post extends Model
{
    public function latest() //
    {
        return DB::table('posts')->latest('published_at')->select('posts.*', 'authors.*')->join('authors', 'posts.author_id', '=', 'authors.id')->limit(1)->get();
    }

    public function add_categories(\stdClass &$post)
    {
        $post->post_categories = $this->category_model->get_by_post($post->post_id);
    }

    public function get(array $filter = [], string $order = DEFAULT_SORT_ORDER, int $page = 1)
    {
        $posts = [];
        $start = ($page - 1) * PER_PAGE;
        $per_page = PER_PAGE;

        if (isset($filter['type'])) {
            $value = $filter['value'];
            if ($filter['type'] === 'category') {
                $category = $this->category_model->find_by_slug($value);
                if ($category) {
                    $posts = $this->get_by_category($category->id, $order, $start, $per_page);
                }
            } elseif ($filter['type'] === 'author') {
                $author = $this->author_model->find_by_slug($value);
                if ($author) {
                    $posts = $this->get_by_author($author->id, $order, $start, $per_page);
                }
            }
        } else {
            $posts = $this->get_unfiltered($order, $start, $per_page);
        }

        $this->add_categories_to_many($posts);

        return $posts;
    }

    public function get_unfiltered(string $order, int $start, int $per_page) //
    {
        return DB::table('posts')->join('authors', 'posts.author_id', '=', 'authors.id')->select('posts.*', 'authors.*')->orderBy('published_at', $order)->offset($start)->limit($per_page)->get();
    }

    public function get_by_category(string $id, string $order, int $start, int $per_page) //
    {
        return DB::table('posts')->join('authors', 'posts.author_id', '=', 'authors.id')->join('category_post', 'posts.id', '=', 'category_post.post_id')->select('posts.*', 'authors.*')->where('category_post.category_id', '52495783-4114-45d5-94fe-07ee4f2de50b')->orderBy('published_at', $order)->offset($start)->limit($per_page)->get();
    }

    public function get_by_author(string $id, string $order, int $start, int $per_page) //
    {
        return DB::table('posts')->join('authors', 'posts.author_id', '=', 'authors.id')->select('posts.*', 'authors.*')->where('posts.author_id', $id)->orderBy('published_at', $order)->offset($start)->limit($per_page)->get();
    }

    public function add_categories_to_many(array $posts)
    {
        foreach ($posts as $post) {
            $post->post_categories = $this->category_model->get_by_post($post->post_id);
        }
    }

    public function count()
    {
        return DB::table('posts')->count();
    }

    public function count_by_category(string $slug)
    {
        return DB::table('posts')->leftJoin('category_post', 'posts.id', '=', 'category_post.post_id')->leftJoin('categories', 'categories.id', '=', 'category_post.category_id')->where('categories.slug', $slug)->selectRaw('count(posts.id)')->get();
    }

    public function count_by_author(string $slug)
    {
        return DB::table('posts')->join('authors', 'posts.author_id', '=', 'authors.id')->where('authors.slug', $slug)->selectRaw('count(posts.id)')->get();
    }

    public function find_by_slug($slug)
    {
        return DB::table('posts')->where('slug', $slug)->get();
    }

    use HasFactory;
}
