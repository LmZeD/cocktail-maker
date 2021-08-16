<?php

use App\Models\Cocktail;
use App\Models\Ingredient;
use App\Models\IngredientInCocktail;
use Illuminate\Database\Seeder;

class CocktailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear previous records
        Ingredient::truncate();
        IngredientInCocktail::truncate();
        Cocktail::truncate();

        // ========= Init ingredients =========
        $vodka = Ingredient::create([
            'name' => 'Vodka',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $gin = Ingredient::create([
            'name' => 'Gin',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $botanicalTonic = Ingredient::create([
            'name' => 'Botanical Tonic',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $tonic = Ingredient::create([
            'name' => 'Tonic',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $whiteRum = Ingredient::create([
            'name' => 'White Rum',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $darkRum = Ingredient::create([
            'name' => 'Dark Rum',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $limeJuice = Ingredient::create([
            'name' => 'Lime Juice',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $lemonJuice = Ingredient::create([
            'name' => 'Lemon Juice',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $silverTequila = Ingredient::create([
            'name' => 'Silver Tequila',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $goldTequila = Ingredient::create([
            'name' => 'Gold (Mature) Tequila',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $cointreau = Ingredient::create([
            'name' => 'Cointreau (Orange triple sec)',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $tripleSec = Ingredient::create([
            'name' => 'Triple sec',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $blueCuracao = Ingredient::create([
            'name' => 'Blue Curacao',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $cranberryJuice = Ingredient::create([
            'name' => 'Cranberry juice',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $simpleSyrup = Ingredient::create([
            'name' => 'Simple syrup',
            'is_active' => 0,
            'pump_no' => 0,
        ]);
        $coffeeLiqueur = Ingredient::create([
            'name' => 'Coffee Liqueur',
            'is_active' => 0,
            'pump_no' => 0,
        ]);


        // ========= Init cocktails =========
        $cocktail = Cocktail::create([
            'name' => 'Gin Tonic (50/50)',
            'notes' => 'Add a wedge of lime.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $gin->id,
            'amount_ml' => 50,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tonic->id,
            'amount_ml' => 50,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Gin Tonic (30/70)',
            'notes' => 'Add a wedge of lime.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $gin->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tonic->id,
            'amount_ml' => 70,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Vodka Gimlet',
            'notes' => '',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 20,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Gin Gimlet',
            'notes' => '',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $gin->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 20,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Margarita (Triple sec)',
            'notes' => 'Rub a lime wedge over the rim of a glass then twist on a plate of coarse salt so it attaches.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $silverTequila->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tripleSec->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 30,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Margarita (Cointreau)',
            'notes' => 'Rub a lime wedge over the rim of a glass then twist on a plate of coarse salt so it attaches.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $silverTequila->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $cointreau->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 30,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Cranberry Gin',
            'notes' => 'Garnish with a few cranberries and mint leaves.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $gin->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $cranberryJuice->id,
            'amount_ml' => 150,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 10,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Vodka Cranberry',
            'notes' => '',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $cranberryJuice->id,
            'amount_ml' => 150,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $simpleSyrup->id,
            'add_by_hand' => true,
            'amount_ml' => 30,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'London cosmopolitan',
            'notes' => '',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $gin->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tripleSec->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $cranberryJuice->id,
            'amount_ml' => 45,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 15,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Balalaika',
            'notes' => 'Garnish with orange zest.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 38,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tripleSec->id,
            'amount_ml' => 38,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $lemonJuice->id,
            'amount_ml' => 38,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Black Russian',
            'notes' => 'Garnish with lemon slice and cherry.',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $coffeeLiqueur->id,
            'add_by_hand' => true,
            'amount_ml' => 23,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Kamikaze',
            'notes' => '',
            'type' => 'Shot',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 30,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $tripleSec->id,
            'amount_ml' => 15,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $limeJuice->id,
            'amount_ml' => 15,
        ]);

        $cocktail = Cocktail::create([
            'name' => 'Hard Lemonade',
            'notes' => 'Add soda water to fill the glass',
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $vodka->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $lemonJuice->id,
            'amount_ml' => 60,
        ]);
        $cocktail->ingredientsInCocktail()->create([
            'ingredient_id' => $simpleSyrup->id,
            'add_by_hand' => true,
            'amount_ml' => 30,
        ]);
    }
}
