<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FavoriteMovie;

class MovieController extends Controller
{
    // movieDb api is hardcoded on server side to provide a maxmimum of 20 movies so we need to call the api twice to get 30 movies
    // if the requirement is to get 30 movies is not strict, then we can just make one api request here
    public function fetchMovies()
    {
        $apiKey = env('MOVIE_DB_API_KEY');
        $response1 = Http::get("https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&language=en-US&page=1");
        $response2 = Http::get("https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&language=en-US&page=2");
    
        $movies1 = $response1->json()['results'];
        $movies2 = $response2->json()['results'];
    
        $movies = array_merge($movies1, $movies2);
        $movies = array_slice($movies, 0, 30);
    
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
