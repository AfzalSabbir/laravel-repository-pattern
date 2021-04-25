<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * @var PostInterface
     */
    protected $postInterface;

    /**
     * PostController constructor.
     * @param PostInterface $postInterface
     */
    public
    function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Post[]|Application|Factory|View|Collection|Response
     */
    public
    function index()
    {
        return view('post', ['posts' => $this->postInterface->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return mixed
     */
    public
    function store(PostRequest $request)
    {
        $this->postInterface->save($request->except('_token', '_method'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed
     */
    public
    function show($id)
    {
        return response()->json($this->postInterface->show($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     */
    public
    function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public
    function update(PostRequest $request, $id): RedirectResponse
    {
        $this->postInterface->update($id, $request->except('_token', '_method'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public
    function destroy($id): RedirectResponse
    {
        $this->postInterface->delete($id);
        return redirect()->back();
    }
}
