<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrioritiesToIngredientsInCocktail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_in_cocktails', function (Blueprint $table) {
            $table->integer('priority')->default(0)->after('amount_ml');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_in_cocktails', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
