<h1>Editar o Post <strong>{{ $post->title }}</strong></h1>

<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title }}">
    @error('title')
        {{ $message }}
    @enderror
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteúdo">{{ $post->content }}</textarea>
    @error('content')
        {{ $message }}
    @enderror
    <button type="submit">Enviar</button>
</form>
