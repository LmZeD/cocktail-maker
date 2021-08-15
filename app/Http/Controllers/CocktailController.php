<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function index()
    {
        $cocktails = Cocktail::with('ingredientsInCocktail')->get();
        $activeIngredients = Ingredient::where('is_active', 1)->get();

        return view('index', compact('cocktails'));
    }

    /**
     * @param Cocktail $cocktail
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function mix(Cocktail $cocktail)
    {
        if (!$cocktail) {
            throw new \Exception('Cocktail not found!');
        }

        if (!$cocktail->isAbleToMake()) {
            throw new \Exception('Can not make this cocktail with current supplies!');
        }

        // @todo add call to arduino here; add a delay depending on the drink or a progress bar
        $returnData = [
            'cocktail' => $cocktail
        ];
        foreach ($cocktail->ingredientsInCocktail as $ingredientInCocktail) {
            if ($ingredientInCocktail->add_by_hand) {
                continue;
            }
            $swaps = $cocktail->getSwappables();
            $pumpNo = $ingredientInCocktail->ingredient->pump_no;
            $amount = $ingredientInCocktail->amount_ml;
            $tmpName = $ingredientInCocktail->ingredient->name;

            foreach ($swaps as $original => $swapped) {
                if ($ingredientInCocktail->ingredient->name === $original) {
                    $pumpNo = Ingredient::where('name', $swapped)->first()->pump_no;
                    $tmpName = $swapped;
                    break;
                }
            }

            $amountInTime = $amount/20;// todo cast to time
            $returnData['progress_elements'][] = [
                'amount' => $amount,
                'time' => $amountInTime,
                'name' => $tmpName
            ];
        }

        $cocktail->times_made++;
        $cocktail->save();

        return redirect()->route('index')->with(['loaderData' => $returnData]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPumpMapping()
    {
        $ingredients = Ingredient::get();

        return view('pump-mapping', compact('ingredients'));
    }

    public function mapPumps(Request $request)
    {
        $data = array_unique($request->toArray());
        $usedIds = [];
        unset($data['_token']);
        foreach ($data as $key => $pump) {
            if ($pump == 0) {
                continue;
            }
            $id = (int)str_replace('ingredient_', '', $key);
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->is_active = true;
            $ingredient->pump_no = $pump;
            $ingredient->save();
            $usedIds[] = $id;
        }

        Ingredient::whereNotIn('id', $usedIds)->update([
            'is_active' => false,
            'pump_no' => 0,
        ]);

        return redirect()->route('cocktail.pump-mapping');
    }
}