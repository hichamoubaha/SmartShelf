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
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'en_promotion' => 'boolean',
            'prix_promotion' => 'nullable|numeric|min:0',
            'rayon_id' => 'required|exists:rayons,id'
        ]);

        $produit = Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'quantite_stock' => $request->quantite_stock,
            'en_promotion' => $request->en_promotion ?? false,
            'prix_promotion' => $request->prix_promotion ?? null,
            'rayon_id' => $request->rayon_id
        ]);

        return response()->json($produit, 201);
    }

    public function show(Produit $produit)
    {
        return $produit->load('rayon');
    }

    public function update(Request $request, $id)
    {
        // Vérifier si le produit existe
        $produit = Produit::find($id);
    
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
    
        // Validation des champs
        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'prix' => 'sometimes|numeric|min:0',
            'quantite_stock' => 'sometimes|integer|min:0',
            'rayon_id' => 'sometimes|exists:rayons,id'
        ]);
    
        // Mettre à jour les champs remplis
        $produit->update($request->all());
    
        return response()->json([
            'message' => 'Produit mis à jour avec succès',
            'produit' => $produit
        ], 200);
    }
    

    public function destroy($id)
    {
        // Vérifier si le produit existe
        $produit = Produit::find($id);
    
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
    
        // Supprimer le produit
        $produit->delete();
    
        return response()->json(['message' => 'Produit supprimé avec succès'], 200);
    }
    
}
