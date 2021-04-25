<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public $request;

    /**
     * @var Post|Builder[]|Collection
     */
    private $post_filter;

    /**
     * PostService constructor.
     * @param $request
     */
    public
    function __construct($request)
    {
        $this->request = $request;
        $this->post_filter = $this->postFilter();
    }

    /**
     * @return Post|Builder[]|Collection
     */
    public
    function postFilter()
    {
        $search = $this->request->search;
        $post = Post::query();
        if ($this->request->search)
            $post = $post->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        return $post;
    }

    /**
     * @param $column
     * @param $order
     * @return Post|Builder[]|Collection
     */
    public
    function postOrder($column, $order)
    {
        return $this->post_filter->orderBy($column, $order);
    }
}
