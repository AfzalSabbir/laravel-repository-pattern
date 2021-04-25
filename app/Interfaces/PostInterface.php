<?php

namespace App\Interfaces;

interface PostInterface
{
    public
    function all();

    /**
     * @param $id
     * @return mixed
     */
    public
    function show($id);

    /**
     * @param $id
     * @return mixed
     */
    public
    function delete($id);

    /**
     * @param array $data
     * @return mixed
     */
    public
    function save(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public
    function edit($id);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public
    function update($id, array $data);
}
