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
        $genre_relations = GenreRelation::all();
        return view('admin.genre_relations.index', [
            'genre_relations' => $genre_relations
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
        $genre_relation = new GenreRelation();
        $genre_relation->genre_id = $request->genre_id;
        $genre_relation->film_id = $request->film_id;
        $genre_relation->save();
        return redirect()->route('admin.genre_relations.index');
    }

    public function edit($id)
    {
        $data = GenreRelation::find($id);
        $genre = Genre::all();
        $film = Film::all();
        return view('admin.genre_relations.edit', [
            'data' => $data,
            'genre' => $genre,
            'film' => $film,
            'selectedGenre' => $data->genre_id,
            'selectedFilm' => $data->film_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $genre_relation = GenreRelation::find($id);
        $genre_relation->genre_id = $request->genre_id;
        $genre_relation->film_id = $request->film_id;
        $genre_relation->save();
        return redirect()->route('admin.genre_relations.index');
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
