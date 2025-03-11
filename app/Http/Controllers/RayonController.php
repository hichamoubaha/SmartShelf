<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
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
