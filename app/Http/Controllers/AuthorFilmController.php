<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorFilmController extends Controller
{
    public function index()
    {
        
        $authorFilm = Film::with('creator')->where('creator_id', Auth::user()->id)
            ->orderBy('release_year', 'desc')
            ->get();
        return view('author.films.index', [
            'authorFilm' => $authorFilm
        ]);
    }

    public function create()
    {
        $creators = User::where('id', Auth::user()->id)->first();
        return view('author.films.create', [
            'creators' => $creators
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'creator_id' => 'required',
            'rating' => 'nullable|numeric',
            'poster' => 'nullable',
            'trailer' => 'nullable',
        ]);

        $film = new Film();
        $film->title = $request->title;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->description = $request->description;
        $film->creator_id = $request->creator_id;
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

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        return view('author.films.edit', [
            'film' => $film
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'creator_id' => 'nullable',
            'rating' => 'required|numeric',
            'poster' => 'nullable',
            'trailer' => 'nullable',
        ]);

        $film = Film::findOrFail($id);
        $film->title = $request->title;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->description = $request->description;
        $film->creator_id = $request->creator_id;
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
            $film->trailer = "https://www.youtube.com/embed/" . $request->trailer;
        }else {
           return back()->withErrors(['trailer' => 'Harap unggah file trailer atau masukkan URL poster.'])->withInput();
        }

        $film->save();
        return redirect()->route('author.films.index');
    }

    public function delete($id)
    {
        $film = Film::find($id);
        $film->delete();
        return redirect()->route('author.films.index');
    }

    public function destroy($id)
    {
        $film = Film::onlyTrashed()->find($id);
        $film->forceDelete();
        return redirect()->route('author.films.trash');
    }

    public function restore($id)
    {
        $film = Film::onlyTrashed()->find($id);
        $film->restore();
        return redirect()->route('author.films.index');
    }

    public function trash()
    {
        $trashedFilm = Film::onlyTrashed()->get();
        return view('author.films.trash', [
            'trashedFilm' => $trashedFilm
        ]);
    }
}
