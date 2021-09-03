@extends('layouts.master')

@php($loaderData =  session()->get('loaderData'))

@section('content')
    <div class="container">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-transparent overflow-hidden shadow sm:rounded-lg">

                    <div class="grid grid-cols-2" style="display: none" id="progress-card">
                        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
                            <div class="flex items-center justify-center">
                                <h3 class="flex items-center text-gray-200">{{ ($loaderData['cocktail']->name ?? '') . __(' Making In Progress...') }}</h3>
                            </div>
                            <div class="flex justify-center">
                                <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
                                    <div id="progress-message"></div>
                                    <div style="width: 40vw; display: flex; justify-content: center; background-color: darkgoldenrod;border-radius: 5px;">
                                        <div id="progress-bar" style="display: flex; width: 1vw; background-color: green; border-radius: 5px;height: 18px; font-weight: 900; justify-content: center">
                                            0%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-2">
                        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
                            <div class="flex items-center justify-center">
                                <h3 class="flex items-center text-gray-200">{{ __('Map pumps') }}</h3>
                            </div>
                            <div class="flex justify-center">
                                <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
                                    <a href="{{ route('cocktail.pump-mapping') }}" class="mt-2" style="border: 1px dashed; border-radius: 5px; padding: 4px 16px; background-color: #4a5568;">
                                        <b>{{__('Open')}}</b>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
                            <div class="flex items-center justify-center">
                                <h3 class="flex items-center text-gray-200">{{ __('Clean up') }}</h3>
                            </div>
                            <div class="flex justify-center">
                                <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
                                    <a href="{{ route('cocktail.clean-up-pumps') }}" class="mt-2" style="border: 1px dashed; border-radius: 5px; padding: 4px 16px; background-color: #4a5568;">
                                        <b>{{__('Open')}}</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1">
                        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
                            <div class="flex items-center justify-center">
                                <h3 class="flex items-center text-gray-200">{{ __('Make custom cocktail') }}</h3>
                            </div>
                            <div class="flex justify-center">
                                <div class="mt-8 text-gray-600 dark:text-gray-400 text-sm text-center">
                                    <a href="{{ route('cocktail.show-custom-cocktail') }}" class="mt-2" style="border: 1px dashed; border-radius: 5px; padding: 4px 16px; background-color: #4a5568;">
                                        <b>{{__('Open')}}</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach($cocktails as $cocktail)
                            @if($cocktail->type === 'Cocktail' && $cocktail->isAbleToMake())
                                @include('partials.cocktail-card')
                            @endif
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1">
                        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-2 ml-2">
                            <div class="flex items-center justify-center">
                                <h3 class="flex items-center text-gray-200">{{ __('Shots') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach($cocktails as $cocktail)
                            @if($cocktail->type === 'Shot' && $cocktail->isAbleToMake())
                                @include('partials.cocktail-card')
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($loaderData))
        <script>
            @php($sumSleep = 0)
            @foreach($loaderData['progress_elements'] as $entry)
                setTimeout(function () {
                    for (var i=0;i<20;i++) {
                        printProgress(i, {{$entry['time']}}*1000/20, '{{$entry['amount']}}', '{{$entry['name']}}');
                    }
                }, {{$sumSleep}}*1000);
                @php($sumSleep += $entry['time'])
            @endforeach

            //fade out the card
            setTimeout(function () {
                var byHandMessage = '';
                @foreach($loaderData['cocktail']->ingredientsInCocktail as $ingredientInCocktail)
                    @if($ingredientInCocktail->add_by_hand)
                    byHandMessage += 'Add ' + '{{$ingredientInCocktail->amount_ml}}ml of {{$ingredientInCocktail->ingredient->name}}' + ' by hand\n';
                @endif
                @endforeach
                document.getElementById('progress-message').innerText = byHandMessage;
                document.getElementById('progress-message').style.fontWeight = 800;
                document.getElementById('progress-message').style.color = 'red';
                setTimeout(function () {
                    for (var i=0;i<100;i++) {
                        fadeOut(i);
                    }
                }, 1000);
            }, {{$sumSleep}}*1000)

            //hide the card
            setTimeout(function () {
                document.getElementById('progress-card').style.display = 'none';
            }, {{$sumSleep+2.1}}*1000)


            // functions
            function fadeOut(i) {
                setTimeout(function () {
                    document.getElementById('progress-card').style.opacity = 1 - 0.01*i;
                }, 10 * i, i);
            }

            function printProgress(i, sleepTime, amount, name) {
                setTimeout(function () {
                    document.getElementById('progress-card').style.display = '';
                    document.getElementById('progress-message').innerText = 'Pouring ' + amount + 'ml of '+name;
                    document.getElementById('progress-bar').style.width = (i+1)*2 + 'vw';
                    document.getElementById('progress-bar').innerText = (i+1)*5+'%';
                }, sleepTime * i, i);
            }
        </script>
    @endif
@endsection
