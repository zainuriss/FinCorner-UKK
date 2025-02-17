<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\GenreRelation;
use Illuminate\Support\Facades\Auth;

class AuthorAddGenreController extends Controller
{
    public function index(){
        $addGenres = GenreRelation::selectRaw('MIN(genre_relations.id) as id, film_id, GROUP_CONCAT(genres.title SEPARATOR ", ") as genres')
        ->join('genres', 'genre_relations.genre_id', '=', 'genres.id') // Join ke tabel genres buat ambil nama genre
        ->join('films', 'genre_relations.film_id', '=', 'films.id') // Join ke tabel films buat ambil judul film
        ->groupBy('film_id', 'films.title') // Group by biar tiap film cuma muncul 1x
        ->selectRaw('films.title as film_title')
        ->get();

        return view('author.add-genres.index', [
            'addGenres' => $addGenres,
        ]);
    }

    public function create()
    {
        $genre = Genre::all();
        $film = Film::where('creator_id', Auth::user()->id)->get();
        return view('author.add-genres.create', [
            'genre' => $genre,
            'film' => $film
        ]);
    }

    public function store(Request $request){
       $request->validate([
            'genre_id' => 'required|array', // Pastikan genre_id adalah array
            'genre_id.*' => 'integer|exists:genres,id', // Setiap item dalam array harus valid
            'film_id' => 'required|integer|exists:films,id',
        ]);
    
        foreach ($request->genre_id as $genreId) {
            GenreRelation::create([
                'genre_id' => $genreId,
                'film_id' => $request->film_id,
            ]);
        }
        
        return redirect()->route('author.add-genres.index');
    }

    public function edit(Request $request, $film_id)
    {

        $data = GenreRelation::select('film_id', 'id')->where('film_id', $film_id)->first();
        $genres = Genre::all(); // Semua genre
        $films = Film::all(); // Semua film
    
        // Ambil semua genre_id yang terhubung dengan film ini
        $selectedGenres = GenreRelation::where('film_id', $data->film_id)->pluck('genre_id')->toArray();
    
        return view('author.add-genres.edit', [
            'data' => $data,
            'genres' => $genres,
            'films' => $films,
            'selectedGenres' => $selectedGenres, // Array genre_id terpilih
            'selectedFilm' => $data->film_id,  
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'genres' => 'nullable|array',         
            'genres.*' => 'exists:genres,id',   
        ]);

        $film = Film::findOrFail($request->film_id);

        $film->genres()->sync($request->genres ?? []);

        return redirect()->route('author.add-genres.index')->with('success', 'Data updated successfully!');
    }

    public function delete($id){
        $film = Genrerelation::where('film_id', $id);
        $film->delete();
        return redirect()->route('author.add-genres.index');
    }

    public function destroy($id){
        $film = GenreRelation::where('film_id', $id);
        $film->forceDelete();
        return redirect()->route('author.add-genres.trash');
    }

    public function restore($id){
        $film = GenreRelation::where('film_id', $id);
        $film->restore();
        return redirect()->route('author.add-genres.trash');
    }

    public function trash(){
        $trashed = GenreRelation::onlyTrashed()->selectRaw('MIN(genre_relations.id) as id, film_id, GROUP_CONCAT(genres.title SEPARATOR ", ") as genres')
        ->join('genres', 'genre_relations.genre_id', '=', 'genres.id') // Join ke tabel genres buat ambil nama genre
        ->join('films', 'genre_relations.film_id', '=', 'films.id') // Join ke tabel films buat ambil judul film
        ->groupBy('film_id', 'films.title') // Group by biar tiap film cuma muncul 1x
        ->selectRaw('films.title as film_title')
        ->get();

        return view('author.add-genres.trash', [
            'trashed' => $trashed,
        ]);
    }
}
