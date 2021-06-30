<h1>Mostrando Post Único</h1>

<div>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Deletar post {{ $post->title }}</button>
    </form>
</div>
