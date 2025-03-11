<?php

namespace App\Jobs;

use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MettreAJourStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $produit;
    protected $quantite;

    public function __construct(Produit $produit, int $quantite)
    {
        $this->produit = $produit;
        $this->quantite = $quantite;
    }

    public function handle()
    {
        if ($this->produit->quantite_stock >= $this->quantite) {
            $this->produit->decrement('quantite_stock', $this->quantite);
        }
    }
}
