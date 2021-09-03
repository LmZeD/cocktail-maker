<?php

namespace App\Http\Controllers;

use App\Jobs\SendCommandToPump;
use App\Models\Cocktail;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function index()
    {
        $cocktails = Cocktail::with('ingredientsInCocktail')->get();

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

            $amountInTime = $amount/Ingredient::ML_PER_SECOND;
            dispatch(new SendCommandToPump($pumpNo, $amountInTime));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cleanUpPumps()
    {
        $ingredients = Ingredient::get();

        return view('clean-up-pumps', compact('ingredients'));
    }

    /**
     * @param Ingredient $ingredient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function initiateCleanUp(Ingredient $ingredient)
    {
        dispatch(new SendCommandToPump($ingredient->pump_no, Ingredient::CLEAN_UP_TIME));

        return redirect(route('cocktail.clean-up-pumps'));
    }

    public function showCustomCocktail()
    {
        $ingredients = Ingredient::where('is_active', 1)->get();

        return view('custom-cocktail', compact('ingredients'));
    }

    public function makeCustomCocktail(Request $request)
    {
        $customCocktail = new Cocktail();
        $ingredientsUsed = [];
        $returnData['progress_elements'] = [];
        foreach ($request->pump as $index => $amount) {
            if ($amount == 0) {
                continue;
            }
            $amountInTime = $amount/Ingredient::ML_PER_SECOND;
            $ingredient = Ingredient::where('pump_no', $index)->where('is_active', 1)->first();
            dispatch(new SendCommandToPump($index, $amountInTime));
            $ingredientsUsed[] = $ingredient;

            $returnData['progress_elements'][] = [
                'amount' => $amount,
                'time' => $amountInTime,
                'name' => $ingredient->name
            ];
        }
        $customCocktail->ingredientsInCocktail = collect($ingredientsUsed);
        $returnData['cocktail'] = $customCocktail;

        return redirect()->route('index')->with(['loaderData' => $returnData]);
    }
}
