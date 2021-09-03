<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
    <div class="flex items-center justify-center">
        <h3 class="flex items-center text-gray-200">{{$ingredient->name}}</h3>
    </div>

    <div class="flex justify-center">
        <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
            <input type="text" name="pump[{{$ingredient->pump_no}}]" placeholder="0 ml">
        </div>
    </div>
</div>

