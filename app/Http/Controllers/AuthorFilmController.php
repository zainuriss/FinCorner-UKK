<?php

namespace App\Http\Controllers;

use App\Models\Casting;
use App\Models\CastingRelation;
use App\Models\Film;
use App\Models\Genre;
use App\Models\GenreRelation;
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

    public function createStep1()
    {
        $creators = Auth::user();
        return view('author.films.create.step1', [
            'creators' => $creators
        ]);
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'age_rating' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poster_url' => 'nullable',
            'trailer' => 'nullable|file|mimes:mp4,mov,avi|max:102400',
            'trailer_url' => 'nullable',
        ]);

        $filmId = Str::uuid();
        $filmData = [
            'id' => $filmId,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'release_year' => $request->release_year,
            'duration' => $request->duration,
            'description' => $request->description,
            'creator_id' => Auth::id(),
            'age_rating' => $request->age_rating,
        ];

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $filmData['poster'] = "storage/" . $posterPath;
        } elseif ($request->poster_url) {
            $filmData['poster'] = $request->poster_url;
        }

        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $filmData['trailer'] = "storage/" . $trailerPath;
        } elseif ($request->trailer_url) {
            $filmData['trailer'] = $request->trailer_url;
        }

        session(['filmData' => $filmData, 'filmId' => $filmId]);

        return redirect()->route('author.films.create.step2');
    }

    public function createStep2()
    {
        $genres = Genre::all();
        $filmId = session('filmId');
        return view('author.films.create.step2', compact('genres', 'filmId'));
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'genre_id' => 'required|array',
            'genre_id.*' => 'exists:genres,id',
        ]);

        session(['genreData' => $request->genre_id]);

        return redirect()->route('author.films.create.step3');
    }

    public function createStep3()
    {
        $castings = Casting::all();
        $filmId = session('filmId');
        return view('author.films.create.step3', compact('castings', 'filmId'));
    }

    public function postStep3(Request $request)
    {
        // $request->validate([
        //     'casting_id' => 'required|array',
        //     'casting_id.*' => 'integer|exists:castings,id',
        // ]);

        $filmData = session('filmData');
        $genreData = session('genreData');
        $castingData = $request->casting_id;

        $filmId = session('filmId');
        $film = Film::create($filmData);

        foreach ($genreData as $genreId) {
            GenreRelation::create([
                'film_id' => $filmId,
                'genre_id' => $genreId,
            ]);
        }

        // Simpan casting ke database
        foreach ($castingData as $castingId) {
            CastingRelation::create([
                'film_id' => $film->id,
                'casting_id' => $castingId,
            ]);
        }

        // Hapus data dari session setelah disimpan
        session()->forget(['filmData', 'genreData', 'filmId']);

        return redirect()->route('author.films.index')->with('success', 'Film berhasil ditambahkan!');
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
