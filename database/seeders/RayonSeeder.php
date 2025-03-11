<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rayon;

class RayonSeeder extends Seeder
{
    public function run(): void
    {
        Rayon::create(['nom' => 'Épicerie', 'description' => 'Produits alimentaires']);
        Rayon::create(['nom' => 'Fruits & Légumes', 'description' => 'Fruits et légumes frais']);
        Rayon::create(['nom' => 'Boucherie', 'description' => 'Viande et charcuterie']);
    }
}
