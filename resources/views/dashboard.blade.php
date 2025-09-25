<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (auth()->user()->role === 'candidate')
                        You are logged in! You can now search for jobs.
                    @elseif (auth()->user()->role === 'employer')
                        You are logged in! You can now post and manage jobs.
                    @elseif (auth()->user()->role === 'admin')
                        You are logged in! Welcome to the admin dashboard.
                    @else
                        You are logged in!
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>