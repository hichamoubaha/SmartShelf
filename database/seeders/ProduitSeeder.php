<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Rayon;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $rayons = Rayon::all();

        foreach ($rayons as $rayon) {
            Produit::create([
                'nom' => 'Produit A - ' . $rayon->nom,
                'description' => 'Description du produit A',
                'prix' => rand(5, 50),
                'stock' => rand(10, 100),
                'en_promotion' => false,
                'prix_promotion' => null,
                'rayon_id' => $rayon->id,
            ]);

            Produit::create([
                'nom' => 'Produit B - ' . $rayon->nom,
                'description' => 'Description du produit B',
                'prix' => rand(5, 50),
                'stock' => rand(10, 100),
                'en_promotion' => true,
                'prix_promotion' => rand(1, 5),
                'rayon_id' => $rayon->id,
            ]);
        }
    }
}
