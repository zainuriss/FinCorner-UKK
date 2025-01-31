<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function landingPage()
    {
        $film = Film::take(8)->get();
        return view('landing-page', [
            'film' => $film
        ]);
    }
    
    public function index()
    {
        $dataFilm =Film::all();
        return view('admin.films.index', [
            'dataFilm' => $dataFilm
        ]);
    }
}
