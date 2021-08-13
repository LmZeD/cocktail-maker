<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'times_made',
        'notes',
        'type',
    ];

    /**
     * @return HasMany
     */
    public function ingredientsInCocktail(): HasMany
    {
        return $this->hasMany(IngredientInCocktail::class);
    }

    /**
     * @return bool
     */
    public function isAbleToMake(): bool
    {
        foreach ($this->ingredientsInCocktail as $ingredientInCocktail) {
            if (!$ingredientInCocktail->ingredient->is_active &&
                $ingredientInCocktail->ingredient->getSwappable() === false &&
                $ingredientInCocktail->ingredient->add_by_hand
            ) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getSwappables(): array
    {
        $toReturn = [];
        foreach ($this->ingredientsInCocktail as $ingredientInCocktail) {
            $swap = $ingredientInCocktail->ingredient->getSwappable();
            if ($swap !== false) {
                $toReturn[$ingredientInCocktail->ingredient->name] = $swap;
            }
        }

        return $toReturn;
    }

}
