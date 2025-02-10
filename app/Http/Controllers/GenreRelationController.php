<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\GenreRelation;

class GenreRelationController extends Controller
{
    public function index()
    {
        $genre_relations = GenreRelation::selectRaw('MIN(genre_relations.id) as id, film_id, GROUP_CONCAT(genres.title SEPARATOR ", ") as genres')
        ->join('genres', 'genre_relations.genre_id', '=', 'genres.id') // Join ke tabel genres buat ambil nama genre
        ->join('films', 'genre_relations.film_id', '=', 'films.id') // Join ke tabel films buat ambil judul film
        ->groupBy('film_id', 'films.title') // Group by biar tiap film cuma muncul 1x
        ->selectRaw('films.title as film_title')
        ->get();

        return view('admin.genre_relations.index', [
            'genre_relations' => $genre_relations,
        ]);
    }

    public function create()
    {
        $genre = Genre::all();
        $film = Film::all();
        return view('admin.genre_relations.create', [
            'genre' => $genre,
            'film' => $film
        ]);
    }

    public function store(Request $request)
    {
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
        
        return redirect()->route('admin.genre_relations.index');
    }

    public function edit($id)
    {
        $data = GenreRelation::find($id);
        $genres = Genre::all(); // Semua genre
        $films = Film::all(); // Semua film
    
        // Ambil semua genre_id yang terhubung dengan film ini
        $selectedGenres = GenreRelation::where('film_id', $data->film_id)->pluck('genre_id')->toArray();
    
        return view('admin.genre_relations.edit', [
            'data' => $data,
            'genres' => $genres,
            'films' => $films,
            'selectedGenres' => $selectedGenres, // Array genre_id terpilih
            'selectedFilm' => $data->film_id,    // Film ID terpilih
        ]);
    }    

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'genres' => 'required|array',         // Genres wajib array
            'genres.*' => 'exists:genres,id',     // Setiap genre_id harus valid
        ]);

        // Cari film terkait
        $data = GenreRelation::find($id);

        // Update relasi film dan genre
        $film_id = $request->film_id;
        $genres = $request->genres;

        // Hapus relasi lama dan buat baru
        GenreRelation::where('film_id', $film_id)->delete();
        foreach ($genres as $genre_id) {
            GenreRelation::create([
                'film_id' => $film_id,
                'genre_id' => $genre_id,
            ]);
        }

        return redirect()->route('admin.genre_relations.index')->with('success', 'Data updated successfully!');
    }


    public function delete($id)
    {
        $genre_relation = GenreRelation::find($id);
        $genre_relation->delete();
        return redirect()->route('admin.genre_relations.index');
    }

    public function show($id)
    {
        $genre_relation = GenreRelation::find($id);
        return view('admin.genre_relations.show', [
            'genre_relation' => $genre_relation
        ]);
    }

    public function trash(){
        $grTrash = GenreRelation::onlyTrashed()->get();
        return view('admin.genre_relations.trash', [
            'grTrash' => $grTrash
        ]);
    }

    public function restore($id){
        $grRestore = GenreRelation::onlyTrashed()->find($id);
        $grRestore->restore();
        return redirect()->route('admin.genre_relations.trash');
    }

    public function destroy($id){
        $grDestroy = GenreRelation::onlyTrashed()->find($id);
        $grDestroy->forceDelete();
        return redirect()->route('admin.genre_relations.trash');
    } 
}
