<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function landingPage()
    {
        $listFilm = Film::take(8)->get();
        return view('landing-page', [
            'listFilm' => $listFilm
        ]);
    }
    
    public function index()
    {
        $dataFilm =Film::all();
        return view('admin.films.index', [
            'dataFilm' => $dataFilm
        ]);
    }

    public function create()
    {
        return view('admin.films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'creator' => 'required',
            'rating' => 'required|numeric',
            'poster' => 'nullable',
            'trailer' => 'nullable',
        ]);

        $film = new Film();
        $film->title = $request->title;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->description = $request->description;
        $film->creator = $request->creator;
        $film->rating = $request->rating;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->trailer = "storage/" . $posterPath;
        } elseif ($request->poster) {
            $film->poster = $request->poster;
        } else {
            return back()->withErrors(['poster' => 'Harap unggah file poster atau masukkan URL poster.'])->withInput();
        }

        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $film->trailer = "storage/" . $trailerPath;
        } elseif ($request->trailer) {
            $film->trailer = $request->trailer;
        }else {
           return back()->withErrors(['trailer' => 'Harap unggah file trailer atau masukkan URL poster.'])->withInput();
        }

        $film->save();
        return redirect()->route('admin.films.index');
    }

    public function destroy($id)
    {
        $film = Film::find($id);
        $film->delete();
        return redirect()->route('admin.films.index');
    }

    public function show($id)
    {
        $showFilm = Film::find($id);
        // dd($showFilm);
        
        // if(!$showFilm) {
        //     return redirect()->route('landing-page')->withErrors('Film tidak ditemukan');
        // }

        return view('show-film', [
            'showFilm' => $showFilm
        ]);
    }
}
