<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Casting;
use Illuminate\Http\Request;

class CastingController extends Controller
{
    public function index()
    {
        $castings = Casting::all();
        return view('admin.casting.index', [
            'castings' => $castings,
        ]);
    }

    public function create()
    {
        $dataFilm = Film::all();
        return view('admin.casting.create', [
            'dataFilm' => $dataFilm,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required',
            'real_name' => 'required',
            'stage_name' => 'required',
        ]);

        Casting::create($request->all());
        return redirect()->route('admin.castings.index');
    }

    public function edit($id)
    {
        $castingEdit = Casting::find($id);
        $dataFilm = Film::all();
        return view('admin.casting.edit', [
            'castingEdit' => $castingEdit,
            'dataFilm' => $dataFilm,
            'selectedFilm' => $castingEdit->film_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'film_id' => 'required',
            'real_name' => 'required',
            'stage_name' => 'required',
        ]);

        $casting = Casting::find($id);
        $casting->update($request->all());
        return redirect()->route('admin.castings.index');
    }

    public function delete($id)
    {
        $casting = Casting::find($id);
        $casting->delete();
        return redirect()->route('admin.castings.index');
    }

    public function destroy($id)
    {
        $casting = Casting::withTrashed()->find($id);
        $casting->forceDelete();
        return redirect()->route('admin.castings.trash');
    }

    public function restore($id)
    {
        $casting = Casting::onlyTrashed()->find($id);
        $casting->restore();
        return redirect()->route('admin.castings.index');
    }

    public function trash()
    {
        $castingTrash = Casting::onlyTrashed()->get();
        return view('admin.casting.trash', [
            'castingTrash' => $castingTrash,
        ]);
    }

}
