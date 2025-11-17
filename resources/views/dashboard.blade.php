<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Banner -->
            <div class="bg-gradient-to-r from-lime-200 via-yellow-100 to-orange-100 rounded-2xl shadow-lg p-12 mb-8">
                <div class="text-center">
                    <h1 class="text-5xl font-bold text-gray-800 mb-2">
                        Achieve Your
                    </h1>
                    <h2 class="text-5xl font-bold mb-2">
                        <span class="text-lime-600">BODY</span>
                        <span class="text-yellow-500"> GOAL</span>
                    </h2>
                    <p class="text-3xl text-gray-700">
                        with <span class="font-bold text-indigo-600">BodyBud</span>
                    </p>
                </div>
            </div>

            <!-- Workout Cards Container with Scroll -->
            <div class="bg-gradient-to-br from-lime-50 to-yellow-50 rounded-2xl shadow-lg p-8 max-h-[600px] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Workout Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Arm Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                    <!-- Workout Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Arm Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                    <!-- Workout Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Arm Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                    <!-- Workout Card 4 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Leg Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                    <!-- Workout Card 5 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Core Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                    <!-- Workout Card 6 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8 flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-16 h-16 mx-auto mt-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Back Workout</h3>
                            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition-colors duration-200 font-medium">
                                Details
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>