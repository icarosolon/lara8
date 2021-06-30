<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Título" value="{{ old('title') }}">
    @error('title')
        {{ $message }}
    @enderror
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteúdo">{{ old('content') }}</textarea>
    @error('content')
        {{ $message }}
    @enderror
    <button type="submit">Enviar</button>
</form>
