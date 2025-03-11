<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\GenreRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', ['genres' => $genres]);
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|',
        ]);

        Genre::create([
            'id' => Str::uuid(),
            'title' =>$request->title,
            'slug' => $request->slug
        ]);
        return redirect()->route('admin.genres.index');
    }

    public function edit($id)
    {
        $genreEdit = Genre::findOrFail($id);
        return view('admin.genre.edit', ['genreEdit' => $genreEdit]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|',
        ]);

        $genreUpdate = Genre::findOrFail($id);
        $genreUpdate->update($request->all());
        return redirect()->route('admin.genres.index');
    }

    public function delete($id)
    {
        $genreDelete = Genre::find($id);
        $genreRelation = GenreRelation::where('genre_id', $id);
        if ($genreRelation) {
            return redirect()->back()->withErrors( 'Data genre tidak bisa dihapus karena masih ada relasi dengan film')->withInput();
        }
        $genreDelete->delete();
        dd($genreRelation);
        return redirect()->route('admin.genres.index');
    }

    public function restore($id)
    {
        $genreRestore = Genre::onlyTrashed()->findOrFail($id);
        $genreRestore->restore();
        return redirect()->route('admin.genres.index');
    }

    public function trash()
    {
        $genres = Genre::onlyTrashed()->get();
        return view('admin.genre.trash', ['genres' => $genres]);
    }

    public function destroy($id)
    {
        $genreForceDelete = Genre::onlyTrashed()->findOrFail($id);
        $genreForceDelete->forceDelete();
        return redirect()->route('admin.genres.index');
    }
}
