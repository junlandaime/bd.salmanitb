<x-app2-layout>
    <x-slot name="header">
        @php
            $user = Auth::user();

            // Urutan = prioritas jika user punya >1 role
            $route = match (true) {
                $user->hasRole('admin') => route('admin.dashboard'),
                $user->hasRole('author') => route('author.dashboard'),
                $user->hasRole('alumni') => route('alumni.dashboard'),
                default => route('dashboard'), // fallback
            };
        @endphp

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ $route }}">{{ __('Dashboard') }}</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
