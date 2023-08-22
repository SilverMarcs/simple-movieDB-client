<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Movie List</h2>
    <a href="/favorites" class="btn btn-primary mb-2">Go to Favorites</a>
    <div class="list-group">
    @foreach($movies as $movie)
        <x-movie-item :title="$movie['title']" :favorited="$movie['isFavorited']" />
    @endforeach

    </div>
</div>
</body>
</html>
