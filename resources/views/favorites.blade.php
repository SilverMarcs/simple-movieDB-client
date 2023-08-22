<a href="/" class="btn btn-primary">Go to Movies List</a>

@foreach($favoriteMovies as $movie)
    <p>{{ $movie->title }}</p>
@endforeach

{{ $favoriteMovies->links() }}
