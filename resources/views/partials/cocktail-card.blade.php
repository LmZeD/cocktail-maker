<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
    <div class="flex items-center justify-center" style="flex-direction: column">
        <h3 class="flex items-center text-gray-200" >{{$cocktail->name}}</h3>
        @php($swappables = $cocktail->getSwappables())
        @if(isset($swappables))
            @foreach($swappables as $original => $swapped)
                <p class="flex items-center text-gray-200" style="margin: 0; color: darkgoldenrod">
                    {{$original}}
                    changed to
                    {{$swapped}}
                </p>
            @endforeach
        @endif
    </div>

    <div class="flex justify-center">
        <div class="text-gray-600 dark:text-gray-400 text-sm text-start flex" style="flex-direction: column">
            @foreach($cocktail->ingredientsInCocktail as $ingredientInCocktail)
                @if ($ingredientInCocktail->add_by_hand)
                    <p style="margin: 2px 0"><b style="color: red">{{__('Add this by hand!')}}</b> {{$ingredientInCocktail->ingredient->name}} : <b>{{$ingredientInCocktail->amount_ml}}</b>ml</p>
                @else
                    <p style="margin: 2px 0">{{$ingredientInCocktail->ingredient->name}} : <b>{{$ingredientInCocktail->amount_ml}}</b>ml</p>
                @endif
            @endforeach
        </div>
    </div>

    <div class="flex justify-center">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center">
            <b>{{ $cocktail->notes ?: 'Enjoy!'}}</b>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
            <a href="{{ route('cocktail.mix', $cocktail) }}" class="mt-2" style="border: 1px dashed; border-radius: 5px; padding: 4px 16px; background-color: #4a5568;">
                <b>{{__('Make')}}</b>
            </a>
        </div>
    </div>
</div>

