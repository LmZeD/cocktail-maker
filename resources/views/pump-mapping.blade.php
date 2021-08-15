@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <form method="post" action="{{ route('cocktail.map-pumps') }}">
                    <div class="grid grid-cols-2 md:grid-cols-2">
                        @csrf
                        @foreach($ingredients as $ingredient)
                            @include('partials.pump-card')
                        @endforeach
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1">
                        <input type="submit" class="mt-2 flex ml-2 align-center" style="font-weight: 800; justify-content:center ;border: 1px dashed; border-radius: 5px; padding: 8px 16px; background-color: #4a5568;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
