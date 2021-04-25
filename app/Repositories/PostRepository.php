<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostInterface
{
    /**
     * @return Post[]|Collection
     */
    public
    function all()
    {
        $post = (new PostService(request()))->postOrder('id', 'desc');
        $post = $post->get()->map->format();
        return $post;
    }

    /**
     * @param $post
     * @return array
     */
    public
    function format($post): array
    {
        return [
            'title'       => $post->title,
            'description' => $post->description,
        ];
    } 

    /**
     * @param $id
     * @return mixed
     */
    public
    function show($id)
    {
        return Post::query()->findOrFail($id)->format();
    }

    /**
     * @param $id
     * @return mixed
     */
    public
    function delete($id)
    {
        return Post::destroy($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public
    function save(array $data)
    {
        return Post::query()->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public
    function edit($id)
    {
        return Post::query()->findOrFail($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public
    function update($id, array $data)
    {
        return Post::query()->findOrFail($id)->update($data);
    }
}
