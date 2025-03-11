<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        return Produit::with('rayon')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'quantite_stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'rayon_id' => 'required|exists:rayons,id'
        ]);

        return Produit::create($request->all());
    }

    public function show(Produit $produit)
    {
        return $produit->load('rayon');
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required',
            'quantite_stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'rayon_id' => 'required|exists:rayons,id'
        ]);

        $produit->update($request->all());
        return $produit;
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(['message' => 'Produit supprimé']);
    }
}
