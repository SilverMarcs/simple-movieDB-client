<a href="/favorites" class="btn btn-primary">Go to Favorites</a>

@foreach($movies as $movie)
    <p>{{ $movie['title'] }}</p>
    <form action="/favorite" method="post">
        @csrf
        <input type="hidden" name="title" value="{{ $movie['title'] }}">
        <button type="submit">Favorite</button>
    </form>
@endforeach
