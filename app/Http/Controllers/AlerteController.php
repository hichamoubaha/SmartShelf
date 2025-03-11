<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class AlerteController extends Controller
{
    public function verifierStocksFaibles()
    {
        // Récupérer les produits ayant un stock faible (moins de 5 unités)
        $produitsFaibles = Produit::where('quantite_stock', '<', 5)->get();

        if ($produitsFaibles->isEmpty()) {
            return response()->json(['message' => 'Aucun produit en stock faible'], 200);
        }

        return response()->json([
            'message' => 'Produits en stock faible',
            'produits' => $produitsFaibles
        ]);
    }
}

