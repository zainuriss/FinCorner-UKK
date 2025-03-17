<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'creator' => 'nullable',
            'age_rating' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poster_url' => 'nullable',
            'trailer' => 'nullable|file|mimes:mp4,mov,avi|max:102400',
            'trailer_url' => 'nullable',
        ]);

        $film = new Film();
        $film->id = Str::uuid();
        $film->title = $request->title;
        $film->slug = Str::slug($request->title);
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->description = $request->description;
        $film->creator_id = $request->creator_id;
        $film->age_rating = $request->age_rating;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = "storage/" . $posterPath;
        } elseif ($request->poster_url) {
            $film->poster = $request->poster_url;
        }

        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $film->trailer = "storage/" . $trailerPath;
        } elseif ($request->trailer_url) {
            $film->trailer = $request->trailer_url;
        }

        $film->save();
        return redirect()->route('author.films.index');
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
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'creator' => 'nullable',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poster_url' => 'nullable',
            'trailer' => 'nullable|file|mimes:mp4,mov,avi|max:102400',
            'trailer_url' => 'nullable',
            'age_rating' => 'required'
        ]);

        $film = Film::find($id);

        if (!$film) {
            return back()->withErrors(['id' => 'Film tidak ditemukan.'])->withInput();
        }

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = "storage/" . $posterPath;
        } elseif ($request->poster_url) {
            $film->poster = $request->poster_url;
        }

        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $film->trailer = "storage/" . $trailerPath;
        } elseif ($request->trailer_url) {
            $film->trailer = $request->trailer_url;
        }

        $film->update([
            'title' => $request->title,
            'release_year' => $request->release_year,
            'duration' => $request->duration,
            'description' => $request->description,
            'creator_id' => $request->creator_id,
            'poster' => $film->poster,
            'trailer' => $film->trailer,
            'age_rating' => $film->age_rating,
            'slug' => Str::slug($request->title)
            
        ]);

        return redirect()->route('films.show', $film->id)->withError([]);
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
