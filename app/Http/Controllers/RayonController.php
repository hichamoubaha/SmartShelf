<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function index()
    {
        return Rayon::all();
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|unique:rayons']);
        return Rayon::create($request->all());
    }

    public function show(Rayon $rayon)
    {
        return $rayon;
    }

    public function update(Request $request, Rayon $rayon)
    {
        $request->validate(['nom' => 'required|unique:rayons,nom,' . $rayon->id]);
        $rayon->update($request->all());
        return $rayon;
    }

    public function destroy(Rayon $rayon)
    {
        $rayon->delete();
        return response()->json(['message' => 'Rayon supprimé']);
    }
}
