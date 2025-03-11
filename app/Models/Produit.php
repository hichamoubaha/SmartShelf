<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'quantite_stock', 'prix', 'rayon_id'];

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
}
