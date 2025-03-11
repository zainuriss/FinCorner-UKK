<?php

namespace App\Http\Controllers;

use App\Models\Casting;
use App\Models\CastingRelation;
use App\Models\Film;
use Illuminate\Http\Request;

class CastingRelationController extends Controller
{
    public function index()
    {
        $castingRelations = CastingRelation::all();
        return view('admin.casting_relations.index',[
            'castingRelations' => $castingRelations
        ]);
    }

    public function create()
    {
        $dataCast = Casting::all();
        $dataFilm = Film::all();
        return view('admin.casting_relations.create',[
            'dataCast' => $dataCast,
            'dataFilm' => $dataFilm
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        CastingRelation::create($data);
        return redirect()->route('admin.casting_relations.index');
    }

    public function edit($id)
    {
        $data = CastingRelation::find($id);
        $dataCast = Casting::all();
        $dataFilm = Film::all();
        return view('admin.casting_relations.edit',[
            'data' => $data,
            'dataCast' => $dataCast,
            'dataFilm' => $dataFilm,
            'selectedFilm' => $data->film_id,
            'selectedCasting' => $data->casting_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = CastingRelation::find($id);
        $data->update($request->all());
        return redirect()->route('admin.casting_relations.index');
    }

    public function delete($id)
    {
        $data = CastingRelation::find($id);
        $data->delete();
        return redirect()->route('admin.casting_relations.index');
    }

    public function trash(){
        $data = CastingRelation::onlyTrashed()->get();
        return view('admin.casting_relations.trash',[
            'data' => $data 
        ]);
    }

    public function restore($id){
        $data = CastingRelation::onlyTrashed()->find($id);
        $data->restore();
        return redirect()->route('admin.casting_relations.trash');
    }

    public function destroy($id)
    {
        $data = CastingRelation::where('id',$id);
        $data->forceDelete();
        return redirect()->route('admin.casting_relations.index');
    }
}
