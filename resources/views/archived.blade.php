<x-layout>
    <section class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="/archive">
                        ARCHIVED
                    </a>
                    
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="/admin">
                        ADMIN
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a>

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </nav>
            @foreach ($products as $product)
                <div
                    class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col hover:scale-105 transition-transform duration-500">
                    <a href="{{ route('product-page', ['id' => $product->id]) }}">
                        <img class="hover:grow hover:shadow-lg h-60" src="{{ $product->getFirstMediaUrl('products') }}">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">{{ $product->name }}</p>

                        </div>
                        <div>
                            <p class="text-gray-400 text-xs ">{{ Str::words($product->small_desc, 15) }}</p>
                        </div>
                        @switch($product->status)
                            @case('pending')
                                <div class="text-yellow-400 text-xs">{{ $product->status }}</div>
                            @break

                            @case('archived')
                                <div class="text-red-600 text-xs">{{ $product->status }}</div>
                            @break

                            @case('published')
                                <div class="text-green-600 text-xs">{{ $product->status }} </div>

                            @default
                                <div class="text-green-600 text-xs"> </div>
                        @endswitch
                        <div class="flex space-x-4">
                            <p class="pt-1 text-gray-900 flex">£ {{ $product->price }} </p>
                            <div class="flex space-x-4">
                                
                            
                                <form action="{{ route('products.restore', ['id' => $product->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    
                                    <button type="submit" class="px-3 py-1 bg-green-300 text-white rounded-xl hover:bg-green-500">Restore</button>
                                </form>
                            </div>
                        </div>

                        
                    </a>
                </div>
                
            @endforeach

    </section>
</x-layout>
