<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IngredientInCocktail extends Model
{
    protected $fillable = [
        'cocktail_id',
        'ingredient_id',
        'amount_ml',
        'priority',
        'add_by_hand',
    ];

    /**
     * @return HasOne
     */
    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class, 'id', 'ingredient_id');
    }
}
