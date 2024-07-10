<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="mt-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-3">
                        {{ __("Here's a random Image from Picsum - Random Image Generator - to make your day worse") }}
                    </p>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        <img src="https://picsum.photos/1200/900" alt="" class="w-full rounded-md">
                        <img src="https://picsum.photos/800/500" alt="" class="w-full rounded-md">
                        <img src="https://picsum.photos/700/350" alt="" class="w-full rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
