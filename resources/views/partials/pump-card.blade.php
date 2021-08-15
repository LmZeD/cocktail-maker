<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
    <div class="flex items-center justify-center">
        <h3 class="flex items-center text-gray-200">{{$ingredient->name}}</h3>
    </div>

    <div class="flex justify-center">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center">
            <b>{{ $ingredient->notes ? $ingredient->pump_no : 'Inactive'}}</b>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
            <select id="ingredient_{{$ingredient->id}}" name="ingredient_{{$ingredient->id}}">
                <option value="0">Inactive</option>
                @for($i=1;$i<9;$i++)
                    <option value="{{$i}}" {{ (int)$ingredient->pump_no === $i ? 'selected' : '' }}>Pump No {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>

