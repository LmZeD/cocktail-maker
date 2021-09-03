<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
    <div class="flex items-center justify-center">
        <h3 class="flex items-center text-gray-200">{{$ingredient->name}}</h3>
    </div>

    <div class="flex justify-center">
        <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
            <a href="{{route('cocktail.initiate-clean-up-pump', $ingredient)}}" type="submit" class="mt-2 flex ml-2 align-center" style="font-weight: 800; justify-content:center ;border: 1px dashed; border-radius: 5px; padding: 8px 16px; background-color: #4a5568;">
                {{__('Clean up')}}
            </a>
        </div>
    </div>
</div>

