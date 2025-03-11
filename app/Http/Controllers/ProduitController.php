<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        return response()->json(Produit::all(), 200);
    }

    public function show($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
        return response()->json($produit, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'en_promotion' => 'boolean',
            'prix_promotion' => 'nullable|numeric',
            'rayon_id' => 'required|exists:rayons,id',
        ]);

        $produit = Produit::create($request->all());

        return response()->json($produit, 201);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->update($request->all());

        return response()->json($produit, 200);
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé'], 200);
    }

    public function search($keyword)
    {
        $produits = Produit::where('nom', 'like', "%{$keyword}%")->get();
        return response()->json($produits, 200);
    }

    public function produitsEnPromotion()
    {
        $produits = Produit::where('en_promotion', true)->get();
        return response()->json($produits, 200);
    }
}
