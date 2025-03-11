<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'prix', 'stock', 'en_promotion', 'prix_promotion', 'rayon_id'];

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
}

//model product