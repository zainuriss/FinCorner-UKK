<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Genre;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\GenreRelation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class FilmController extends Controller
{
    public function landingPage()
    {
        $averageRatings = [];
        $latestFilm = Film::where('release_year', '<=', date('Y'))->orderBy('release_year', 'desc')->take(10)->get();
        foreach ($latestFilm as $film) {
            $averageRatings[$film->id] = Comment::where('film_id', $film->id)
                ->whereHas('user', function ($query) {
                    $query->where('role', 'subscriber');
                })
                ->avg('rating');
        }
        // dd($averageRatings);
        $listFilm = Film::take(8)->get();
        $genreCard = Genre::take(6)->get();

        return view('landing-page', [
            'listFilm' => $listFilm,
            'latestFilm' => $latestFilm,
            'genreCard' => $genreCard,
            'averageRatings' => $averageRatings
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
        $creators = User::where('role', 'author')->get();
        return view('admin.films.create', [
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
        return redirect()->route('admin.films.index');
    }

    public function delete($id)
    {
        $film = Film::find($id);
        $film->delete();
        return redirect()->route('admin.films.index');
    }

    public function show($slug)
    {
        $showFilm = Film::where('slug', $slug)->firstOrFail();
        $averageRating = Comment::where('film_id', $showFilm->id)
            ->whereHas('user', function ($query) {
                $query->where('role', 'subscriber');
            })
            ->avg('rating');

        $totalRating = Comment::where('film_id', $showFilm->id)
            ->whereHas('user', function ($query) {
                $query->where('role', 'subscriber');
            })
            ->count();

        $showGenreFilm = GenreRelation::with('genres')
            ->where('film_id', $showFilm->id)
            ->get();
        $showCastings = Film::with('casting')->where('id', $showFilm->id)->get();
        $commentView = Comment::where('film_id', $showFilm->id)->orderByDesc('created_at')->get();
        $durationFormat = floor($showFilm->duration / 60) . 'h ' . ($showFilm->duration % 60) . 'm';

        $existingComment = false;
        if (Auth::check()) {
            $existingComment = Comment::where('user_id', Auth::user()->id)
                ->where('film_id', $showFilm->id)
                ->exists();
        }

        return view('show-film', [
            'showGenreFilm' => $showGenreFilm,
            'showFilm' => $showFilm,
            'showCastings' => $showCastings,
            'commentView' => $commentView,
            'durationFormat' => $durationFormat,
            'existingComment' => $existingComment,
            'averageRating' => $averageRating,
            'totalRating' => $totalRating,
        ]);
    }

    public function edit($id)
    {
        $ageRatings = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
        $creators = User::where('role', 'author')->get();
        $editFilm = Film::find($id);
        return view('edit-film', [
            'editFilm' => $editFilm,
            'creators' => $creators,
            'ageRatings' => $ageRatings
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

        return redirect()->route('films.show', $film->slug)->withError([]);
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

    public function searchInLandingPage(Request $request)
    {
        if ($request->title) {
            $genres = Genre::all();
            $searchFilm = Film::where('title', 'like', '%' . $request->title . '%')->get();
            if ($searchFilm->count() == 0) {
                return redirect()->route('landing-page')->with('error', 'Film tidak ditemukan.');
            }
            return view('show-all-film', [
                'showAllFilm' => $searchFilm,
                'genres' => $genres
            ]);
        } else {
            return redirect()->route('landing-page');
        }
    }

    public function filter(Request $request)
    {
        $genres = Genre::all();
        $query = Film::query(); 
        $years = $query->distinct()->orderBy('release_year', 'desc')->pluck('release_year');
    
        if ($request->has('genre_id') && !empty($request->genre_id)) {
            $genreUUID = (string) $request->genre_id;
    
            $filmIds = GenreRelation::where('genre_id', $genreUUID)
                ->pluck('film_id'); 
    
            if ($filmIds->isEmpty()) {
                return redirect()->route('films.filter')->withErrors('Film pada genre ini tidak ditemukan.')->withInput();
            }
    
            $query->whereIn('id', $filmIds);
        }
    
        if ($request->has('age_rating') && !empty($request->age_rating)) {
            $query->where('age_rating', $request->age_rating);
        }
    
        if ($request->has('title') && !empty($request->title)) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('release_year') && !empty($request->release_year)) {
            $query->where('release_year', $request->release_year);
        }
    
        if ($request->has('avg_rating') && !empty($request->avg_rating)) {
            $minRating = (int) $request->avg_rating;
            $maxRating = $minRating + 1; 
    
            $filteredFilmIds = Comment::whereHas('user', function ($q) {
                    $q->where('role', 'subscriber');
                })
                ->selectRaw('film_id, AVG(rating) as avg_rating')
                ->groupBy('film_id')
                ->havingRaw('avg_rating BETWEEN ? AND ?', [$minRating, $maxRating])
                ->pluck('film_id');
    
            $query->whereIn('id', $filteredFilmIds);
        }
    
        $showAllFilm = $query->get(); 
    
        return view('show-all-film', [
            'genres' => $genres,
            'years' => $years,
            'showAllFilm' => $showAllFilm,
        ]);
    }
}
