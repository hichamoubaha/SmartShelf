<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('produits', function (Blueprint $table) {
        $table->decimal('prix_promotion', 8, 2)->nullable();
    });
}

public function down()
{
    Schema::table('produits', function (Blueprint $table) {
        $table->dropColumn(['nom', 'prix', 'quantite_stock', 'en_promotion', 'prix_promotion', 'rayon_id']);
    });
}

};
