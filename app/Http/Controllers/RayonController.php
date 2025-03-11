<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Récupérer tous les rayons
     */
    public function index()
    {
        $rayons = Rayon::all();
        return response()->json($rayons);
    }

    /**
     * Ajouter un nouveau rayon
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon = Rayon::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return response()->json($rayon, 201);
    }

    /**
     * Modifier un rayon existant
     */
    public function update(Request $request, $id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon->update($request->only(['nom', 'description']));

        return response()->json($rayon);
    }

    /**
     * Supprimer un rayon
     */
    public function destroy($id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $rayon->delete();

        return response()->json(['message' => 'Rayon supprimé avec succès']);
    }

    /**
     * Récupérer les produits d'un rayon spécifique
     */
    public function getProduitsParRayon($id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $produits = Produit::where('rayon_id', $id)->get();

        return response()->json($produits);
    }
}
