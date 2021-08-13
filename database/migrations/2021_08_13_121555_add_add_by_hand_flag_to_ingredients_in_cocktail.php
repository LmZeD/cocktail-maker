<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddByHandFlagToIngredientsInCocktail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_in_cocktails', function (Blueprint $table) {
            $table->boolean('add_by_hand')->after('priority')->default(false);
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
            $table->dropColumn('add_by_hand');
        });
    }
}
