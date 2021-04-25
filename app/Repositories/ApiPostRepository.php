<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class ApiPostRepository implements PostInterface
{
    /**
     * @return Post[]|Collection
     */
    public
    function all()
    {
        return Post::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public
    function show($id)
    {
        return Post::findOrFail($id);
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
        return Post::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public
    function edit($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public
    function update($id, array $data)
    {
        return Post::findOrFail($id)->update($data);
    }
}
