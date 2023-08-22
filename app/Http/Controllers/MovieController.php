<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FavoriteMovie;

class MovieController extends Controller
{
    public function fetchMovies()
{
    $apiKey = env('MOVIE_DB_API_KEY');
    $response = Http::get("https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&language=en-US");

    $movies = $response->json()['results'];

    return view('movies', ['movies' => $movies]);
}

public function favoriteMovie(Request $request)
{
    $favoriteMovie = new FavoriteMovie;
    $favoriteMovie->title = $request->title;
    $favoriteMovie->save();

    return back();
}

public function showFavorites()
{
    $favoriteMovies = FavoriteMovie::paginate(10);

    return view('favorites', ['favoriteMovies' => $favoriteMovies]);
}


}
