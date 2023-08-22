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
        $response = Http::get("https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&language=en-US&per_page=30");

        $movies = $response->json()['results'];

        foreach ($movies as $key => $movie) {
            $movies[$key]['isFavorited'] = $this->isFavorited($movie['title']);
        }

        return view('movies', ['movies' => $movies]);
    }

    public function showFavorites()
    {
        $favoriteMovies = FavoriteMovie::paginate(10);

        foreach ($favoriteMovies as $movie) {
            $movie->isFavorited = $this->isFavorited($movie->title);
        }

        return view('favorites', ['favoriteMovies' => $favoriteMovies]);
    }

    public function isFavorited($title)
    {
        return FavoriteMovie::where('title', $title)->exists();
    }

    public function favorite(Request $request)
    {
        $title = $request->input('title');
        $action = $request->input('action');

        if ($action === 'add') {
            // Add to favorites
            $favorite = new FavoriteMovie;
            $favorite->title = $title;
            $favorite->save();
        } elseif ($action === 'remove') {
            // Remove from favorites
            FavoriteMovie::where('title', $title)->delete();
        }

        return back();
    }



}
