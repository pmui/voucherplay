<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <div class="flex space-x-4">
                    <div class="relative">
                        <select class="appearance-none rounded-l-md px-4 py-2 border border-gray-300 bg-white text-gray-700 leading-tight focus:outline-none focus:border-gray-500 focus:ring-1 focus:ring-gray-500">
                            <option selected disabled>Filter by Status</option>
                            <option>Success</option>
                            <option>Cancel</option>
                            <option>Expired</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 6.707a1 1 0 0 1 1.414 0L10 9.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"/></svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select class="appearance-none rounded-l-md px-4 py-2 border border-gray-300 bg-white text-gray-700 leading-tight focus:outline-none focus:border-gray-500 focus:ring-1 focus:ring-gray-500">
                            <option selected disabled>Filter by Game Title</option>
                            <option>Game Title 1</option>
                            <option>Game Title 2</option>
                            <option>Game Title 3</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 6.707a1 1 0 0 1 1.414 0L10 9.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"/></svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select class="appearance-none rounded-l-md px-4 py-2 border border-gray-300 bg-white text-gray-700 leading-tight focus:outline-none focus:border-gray-500 focus:ring-1 focus:ring-gray-500">
                            <option selected disabled>Filter by Payment Method</option>
                            <option>Credit Card</option>
                            <option>Paypal</option>
                            <option>Bitcoin</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

