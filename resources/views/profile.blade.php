<x-layout>

    <div class="h-screen dark:bg-gray-700 bg-gray-200 pt-12">

        <!-- Card start -->
        <div class="max-w-sm mx-auto bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg">
            <div class="border-b px-4 pb-6">
                <div class="text-center my-4">
                    <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4"
                        src="{{ $user->hasMedia('users') ? $user->getMedia('users')->last()->getUrl() : '/images/pp.png' }}"
                        alt="">
                    <div class="py-2">
                        <h3 class="font-bold text-2xl text-gray-800 dark:text-white mb-1">{{ $user->name }}</h3>
                        <div class="inline-flex text-gray-700 dark:text-gray-300 items-center">

                            {{ $user->userable_type }}
                        </div>
                    </div>
                </div>
                @if (Auth::id() === $user->id)
                    <a href="/profile">
                    <div class="flex gap-2 px-2">
                        <button
                            class="flex-1 rounded-full bg-blue-600 dark:bg-blue-800 text-white dark:text-white antialiased font-bold hover:bg-blue-800 dark:hover:bg-blue-900 px-4 py-2">
                            Edit
                        </button>

                    </div>
                </a>
                @endif
                
            </div>
            <div class="px-4 py-4">

                <div class="flex items-center justify-center">
                    <div class="flex justify-end mr-2 items-center">

                        <div class=" flex items-center space-x-3">
                            @if ($user->achievements)
                                @foreach ($user->achievements as $achievement)
                                <div class="relative inline-block group">
                                    <div class="w-12 h-12 bg-gray-200 flex items-center justify-center rounded-full">
                                        {!! $achievement['icon'] !!}
                                    </div>
                                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-32 text-center text-white bg-black text-sm rounded-lg py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        {{ $achievement['title'] }}
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p>No achievements found.</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Card end -->

    </div>



</x-layout>
