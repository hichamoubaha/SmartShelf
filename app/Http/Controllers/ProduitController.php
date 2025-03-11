<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Jobs\MettreAJourStockJob;

class ProduitController extends Controller
{

    public function getProduitsEnPromotion()
    {
        try {
            $produits = Produit::where('en_promotion', true)->get();

            return response()->json($produits, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function vendreProduit(Request $request, Produit $produit)
{
    $request->validate([
        'quantite' => 'required|integer|min:1',
    ]);

    dispatch(new MettreAJourStockJob($produit, $request->quantite));

    return response()->json(['message' => 'Commande en cours de traitement']);
}

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
