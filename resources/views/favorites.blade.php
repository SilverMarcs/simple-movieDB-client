<!DOCTYPE html>
<html>
<head>
    <title>Favorite Movies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Favorite Movies</h2>
    <a href="/" class="btn btn-primary mb-2">Go to Movies List</a>
    <div class="list-group">
    @foreach($favoriteMovies as $movie)
        <x-movie-item :title="$movie->title" :favorited="$movie->isFavorited" />
    @endforeach

    </div>
    <div class="mt-4">
        {{ $favoriteMovies->links() }}
    </div>
</div>
</body>
</html>
