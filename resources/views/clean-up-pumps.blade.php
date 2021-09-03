@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-2">
                    @csrf
                    @foreach($ingredients as $ingredient)
                        @if($ingredient->is_active)
                            @include('partials.clean-up-pump-card')
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
