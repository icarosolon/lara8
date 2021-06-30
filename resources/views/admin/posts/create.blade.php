@extends('layouts.app')
@section('title', 'Criar Post')
@section('content')
    <form action="{{ route('posts.store') }}" method="post">
        @include('admin.posts._partials.form')
    </form>
@endsection
