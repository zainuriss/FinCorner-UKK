<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\GenreRelation;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function landingPage()
    {
        $listFilm = Film::take(8)->get();
        $genreCard = Genre::take(6)->get();
        $latestFilm = Film::where('release_year', '<=', date('Y'))->orderBy('release_year', 'desc')->take(10)->get();
        return view('landing-page', [
            'listFilm' => $listFilm,
            'latestFilm' => $latestFilm,
            'genreCard' => $genreCard
        ]);
    }
    
    public function index()
    {
        $dataFilm =Film::orderBy('title', 'asc')->get();
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
            $film->trailer = "https://www.youtube.com/embed/" . $request->trailer;
        }else {
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
        // $genreFilm = GenreRelation::with('genre')->where($showFilm)->get();
        // // dd($showFilm);
        
        // if(!$showFilm) {
        //     return redirect()->route('landing-page')->withErrors('Film tidak ditemukan');
        // }

        return view('show-film', [
            'showGenreFilm' => $showGenreFilm,
            'showFilm' => $showFilm
        ]);
    }

    public function edit($id){
        $editFilm = Film::find($id);
        return view('edit-film', [
            'editFilm' => $editFilm,
        ]);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'creator' => 'required',
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
            'creator' => $request->creator,
            'poster' => $film->poster, // Gunakan hasil dari proses di atas
            'trailer' => $film->trailer, // Gunakan hasil dari proses di atas
        ]);
    
        // dd($store);

        return redirect()->route('films.show', $film->id)->withError([  ]);
    }    
    
    public function trash()
    {
        $trashFilm = Film::onlyTrashed()->get();
        return view('admin.films.trash', [
            'trashFilm' => $trashFilm
        ]);
    }

    public function restore($id){
        $restoreFilm = Film::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.films.index', [
            'restoreFilm' => $restoreFilm,
        ]);
    }

    public function destroy($id){
        $forceDeleteFilm = Film::onlyTrashed()->where($id)->forceDelete();
        return redirect()->route('admin.films.index', [
            'forceDeleteFilm' => $forceDeleteFilm
        ]);
    }
}
