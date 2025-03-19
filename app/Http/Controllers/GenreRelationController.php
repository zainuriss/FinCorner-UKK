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
        $genre_relations = GenreRelation::with(['genres' => function ($query) {
            $query->whereNull('deleted_at');
        }])->with('film')->get()->groupBy('film_id');

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
            'genre_id.*' => 'exists:genres,id', // Setiap item dalam array harus valid
            'film_id' => 'required|exists:films,id',
        ]);

        foreach ($request->genre_id as $genreId) {
            GenreRelation::create([
                'genre_id' => $genreId,
                'film_id' => $request->film_id,
            ]);
        }

        return redirect()->route('admin.genre_relations.index');
    }

    public function edit(Request $request, $film_id)
    {

        $data = GenreRelation::select('film_id', 'id')->where('film_id', $film_id)->first();        // dd($data);
        $genres = Genre::all(); // Semua genre
        $films = Film::all(); // Semua film

        // Ambil semua genre_id yang terhubung dengan film ini
        $selectedGenres = GenreRelation::where('film_id', $data->film_id)->pluck('genre_id')->toArray();

        return view('admin.genre_relations.edit', [
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

        return redirect()->route('admin.genre_relations.index')->with('success', 'Data updated successfully!');
    }


    public function delete($id)
    {
        $genre_relation = GenreRelation::where('film_id', $id);
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

    public function trash()
    {
        $grTrash = GenreRelation::onlyTrashed()->selectRaw('MIN(genre_relations.id) as id, film_id, GROUP_CONCAT(genres.title SEPARATOR ", ") as genres')
            ->join('genres', 'genre_relations.genre_id', '=', 'genres.id') // Join ke tabel genres buat ambil nama genre
            ->join('films', 'genre_relations.film_id', '=', 'films.id') // Join ke tabel films buat ambil judul film
            ->groupBy('film_id', 'films.title') // Group by biar tiap film cuma muncul 1x
            ->selectRaw('films.title as film_title')
            ->get();

        return view('admin.genre_relations.trash', [
            'grTrash' => $grTrash
        ]);
    }

    public function restore($id)
    {
        $grRestore = GenreRelation::where('film_id', $id);
        $grRestore->restore();
        return redirect()->route('admin.genre_relations.trash');
    }

    public function destroy($id)
    {
        $grDestroy = GenreRelation::where('film_id', $id);
        $grDestroy->forceDelete();
        return redirect()->route('admin.genre_relations.trash');
    }
}
