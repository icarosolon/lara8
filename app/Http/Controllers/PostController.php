<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(1);
        //dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePostRequest $request)
    {

        $post = Post::create($request->all());

        return redirect()->route('posts.index')->with('message', 'Post criado com sucesso!');
        //        return view('admin.posts.create');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        if (!$post = Post::find($id))
            return redirect()->back();

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePostRequest $request, $id)
    {
        if (!$post = Post::find($id))
            return redirect()->back();

        $post->update($request->all());
        return redirect()->route('posts.index')->with('message', 'Post ' . $post->title . 'editado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$post = Post::find($id))
            return redirect()->route('posts.index');
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $posts = Post::where('title', 'like', "%{$request->search}%")
            ->orWhere('content', 'like', "%{$request->search}%")
            ->paginate(1);
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
