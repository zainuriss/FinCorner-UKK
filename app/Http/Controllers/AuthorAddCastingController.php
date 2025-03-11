<?php

namespace App\Http\Controllers;

use App\Models\Casting;
use App\Models\CastingRelation;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorAddCastingController extends Controller
{
    public function index()
    {
        $castingRelations = CastingRelation::with(['film', 'casting'])
            ->whereHas('film', function($query){
                $query->where('creator_id', Auth::user()->id);
            })->get();
        return view('author.add-castings.index',[
            'castingRelations' => $castingRelations
        ]);
    }

    public function create()
    {
        $dataCast = Casting::all();
        $dataFilm = Film::where('creator_id', Auth::user()->id)->get();
        return view('author.add-castings.create',[
            'dataCast' => $dataCast,
            'dataFilm' => $dataFilm
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        CastingRelation::create($data);
        return redirect()->route('author.add-castings.index');
    }

    public function edit($id)
    {
        $data = CastingRelation::find($id);
        $dataCast = Casting::all();
        $dataFilm = Film::where('creator_id', Auth::user()->id)->get();
        return view('author.add-castings.edit',[
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
        return redirect()->route('author.add-castings.index');
    }

    public function delete($id)
    {
        $data = CastingRelation::find($id);
        $data->delete();

        return redirect()->route('author.add-castings.index');
    }

    public function trash(){
        $data = CastingRelation::with(['film', 'casting'])
        ->whereHas('film', function($query){
            $query->where('creator_id', Auth::user()->id);
        })->onlyTrashed()->get();
        return view('author.add-castings.trash',[
            'data' => $data
        ]);
    }

    public function restore($id){
        $data = CastingRelation::onlyTrashed()->find($id);
        $data->restore();
        return redirect()->route('author.add-castings.trash');
    }

    public function destroy($id)
    {
        $data = CastingRelation::where('id',$id);
        $data->forceDelete();
        return redirect()->route('author.add-castings.index');
    }
}
