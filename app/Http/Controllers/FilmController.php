<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Genre;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\GenreRelation;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    public function landingPage()
    {
        $listFilm = Film::take(10)->get();
        $genreCard = Genre::take(6)->get();
        $latestFilm = Film::where('release_year', '<=', date('Y'))->orderBy('release_year', 'desc')->take(10)->get();
        return view('landing-page', [
            'listFilm' => $listFilm,
            'latestFilm' => $latestFilm,
            'genreCard' => $genreCard,
        ]);
    }

    public function index()
    {

        $dataFilm = Film::orderBy('title', 'asc')->get();
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
            'creator' => 'nullable',
            'rating' => 'required|numeric',
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
        } else {
            return back()->withErrors(['trailer' => 'Harap unggah file trailer atau masukkan URL poster.'])->withInput();
        }

        $film->save();
        return redirect()->route('admin.films.index');
    }

    public function delete($id)
    {
        $film = Film::find($id);
        $film->delete();
        return redirect()->route('admin.films.index');
    }

    public function show($id)
    {
        $showFilm = Film::find($id);
        $showGenreFilm = GenreRelation::with('genres')
            ->where('film_id', $id)
            ->get();
        $showCastings = Film::with('casting')->where('id', $id)->get();
        $commentView = Comment::where('film_id', $id)->orderByDesc('created_at')->get();
        $durationFormat = floor($showFilm->duration / 60) . 'h ' . ($showFilm->duration % 60) . 'm';

        $existingComment = Comment::where('user_id', Auth::user()->id)
            ->where('film_id', $id)
            ->exists();

        return view('show-film', [
            'showGenreFilm' => $showGenreFilm,
            'showFilm' => $showFilm,
            'showCastings' => $showCastings,
            'commentView' => $commentView,
            'durationFormat' => $durationFormat,
            'existingComment' => $existingComment
        ]);
    }

    public function edit($id)
    {
        $creators = User::where('role', 'author')->get();
        $editFilm = Film::find($id);
        return view('edit-film', [
            'editFilm' => $editFilm,
            'creators' => $creators
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
        ]);

        $film = Film::find($id);

        if (!$film) {
            return back()->withErrors(['id' => 'Film tidak ditemukan.'])->withInput();
        }

        // Proses Poster
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = "storage/" . $posterPath;
        } elseif ($request->poster_url) {
            $film->poster = $request->poster_url;
        }

        // Proses Trailer
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $film->trailer = "storage/" . $trailerPath;
        } elseif ($request->trailer_url) {
            $film->trailer = $request->trailer_url;
        }

        // Simpan perubahan
        $film->update([
            'title' => $request->title,
            'release_year' => $request->release_year,
            'duration' => $request->duration,
            'description' => $request->description,
            'creator_id' => $request->creator_id,
            'poster' => $film->poster, // Gunakan hasil dari proses di atas
            'trailer' => $film->trailer, // Gunakan hasil dari proses di atas
        ]);

        // dd($store);

        return redirect()->route('films.show', $film->id)->withError([]);
    }

    public function trash()
    {
        $trashFilm = Film::onlyTrashed()->get();
        return view('admin.films.trash', [
            'trashFilm' => $trashFilm
        ]);
    }

    public function restore($id)
    {
        $restoreFilm = Film::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.films.index', [
            'restoreFilm' => $restoreFilm,
        ]);
    }

    public function destroy($id)
    {
        $forceDeleteFilm = Film::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.films.index', [
            'forceDeleteFilm' => $forceDeleteFilm
        ]);
    }

    public function search(Request $request)
    {
        if ($request->title) {
            $searchFilm = Film::where('title', 'like', '%' . $request->title . '%')->get();
            if ($searchFilm->count() == 0) {
                return redirect()->route('films.showAll')->with('error', 'Film tidak ditemukan.');
            }
        } else {
            $searchFilm = Film::all();
        }

        $genres = Genre::all();
        $request->session()->forget('title');
        return view('show-all-film', [
            'showAllFilm' => $searchFilm,
            'genres' => $genres
        ]);
    }

    public function searchInLandingPage(Request $request)
    {
        if ($request->title) {
            $searchFilm = Film::where('title', 'like', '%' . $request->title . '%')->get();
            if ($searchFilm->count() == 0) {
                return redirect()->route('films.showAll')->with('error', 'Film tidak ditemukan.');
            }
            return view('show-all-film', [
                'showAllFilm' => $searchFilm
            ]);
        } else {
            return redirect()->route('landing-page');
        }
    }

    public function genresFilter(Request $request)
    {
        if ($request->genre) {
            $filterGenreFilm = GenreRelation::with('genres', 'films')->where('genre_id', $request->genre)->get();
            if ($filterGenreFilm->count() == 0) {
                return redirect()->route('films.search')->withErrors('Film tidak ditemukan.')->withInput();
            }
        } else {
            $filterGenreFilm = Film::all();
        }
        $request->session()->forget('genre');
        return view('show-all-film', [
            'showGenres' => $filterGenreFilm
        ]);
    }
}
