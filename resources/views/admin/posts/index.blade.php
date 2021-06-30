@extends('layouts.app')
@section('title', 'Listagem dos Posts')
@section('content')
    <a href="{{ route('posts.create') }}">Novo Post</a>
    <hr>
    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
    <h1>Index de post</h1>
    <p>Filtro</p>
    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" id="search" placeholder="Pesquisar...">
        <button type="submit">Filtrar</button>
    </form>

    <div>
        @foreach ($posts as $post)
            <p>{{ $post->title }} -
                [
                <a href="{{ route('posts.show', $post->id) }}">Ver</a>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                ]
            </p>

        @endforeach
        <hr>
        @if (isset($filters))
            {{ $posts->appends($filters)->links() }}
        @else
            {{ $posts->links() }}
        @endif

    </div>

@endsection
