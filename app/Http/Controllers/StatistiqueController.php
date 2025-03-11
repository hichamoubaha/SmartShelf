<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function statistiquesStocks()
    {
        $produits = Produit::all();

        $stats = [
            'total_produits' => $produits->count(),
            'produits_en_promotion' => $produits->where('en_promotion', true)->count(),
            'produits_en_rupteur' => $produits->where('quantite_stock', '<', 5)->count(), // Produits en rupture
            'produits_populaires' => $produits->sortByDesc('ventes')->take(5)->values(), // Top 5 des ventes
        ];

        return response()->json($stats);
    }
}
