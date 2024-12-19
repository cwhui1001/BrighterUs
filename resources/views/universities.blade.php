<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Universities') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-text">
                
                {{ __("Welcome to the Universities page!") }}

            </div>
        </div>
    </div>
    <p>Welcome to the Universities page!</p>
</x-app-layout>
