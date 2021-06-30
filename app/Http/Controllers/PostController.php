<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(5);
        //dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePostRequest $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {

            $nameFile = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();

            $file = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $file;
        }


        $post = Post::create($data);

        return redirect()->route('posts.index')->with('message', 'Post criado com sucesso!');
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

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {

            $nameFile = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();

            $file = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $file;
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('message', 'Post ' . $post->title . 'editado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$post = Post::find($id))
            return redirect()->route('posts.index');

        if (Storage::exists($post->image))
            Storage::delete($post->image);
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
