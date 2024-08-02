<x-layout>
    <style>
        
        #loading {
            text-align: center;
            padding: 20px;
        }
    </style>
    <section class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="#">
                        Store
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a>

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
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
                        <img class="hover:grow hover:shadow-lg h-60"
                            src="{{ $product->getFirstMediaUrl('products') }}">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">{{ $product->name }}</p>


                            @if($product->favorites()->where('user_id',auth()->id())->exists())
                                <form action="{{ route('remove.favorite') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="productId" />
                                
                                <button type="submit">
                                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black @if($product->favorites()->where('user_id',auth()->id())->exists()) text-red-500 @endif"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                    </svg>

                                </button>
                                
                                

                            </form>
                            
                           
                                
                            @else
                               <form action="{{ route('add.favorite') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="productId" />
                                
                                <button type="submit">
                                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black @if($product->favorites()->where('user_id',auth()->id())->exists()) text-red-500 @endif"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                    </svg>

                                </button>
                             
                                
                                

                            </form>  
                            
                            @endif
                             
                           

                            @if($product->addedToCard()->where('user_id',auth()->id())->exists())
                            <form action="{{ route('remove.card') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="productId" />
                                <button type="submit">
                                    <svg class="fill-current hover:text-black @if($product->addedToCard()->where('user_id',auth()->id())->exists()) text-blue-500 @endif" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                                    <circle cx="10.5" cy="18.5" r="1.5" />
                                    <circle cx="17.5" cy="18.5" r="1.5" />
                                </svg>
                                </button>


                            </form>
                            @else
                            <form action="{{ route('add.card') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="productId" />
                                <button type="submit" >
                                    <svg class="fill-current  hover:text-blue-500 " xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                                    <circle cx="10.5" cy="18.5" r="1.5" />
                                    <circle cx="17.5" cy="18.5" r="1.5" />
                                </svg>
                                </button>


                            </form>

                            @endif
                           
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs ">{{ Str::words($product->small_desc , 15) }}</p>
                        </div>
                        <p class="pt-1 text-gray-900">£ {{ $product->price }}</p>
                    </a>
                </div>
            @endforeach
                
            <div id="pagination">
                {{ $products->links() }}
            </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let content = document.getElementById('content');
            let pagination = document.getElementById('pagination');
            let nextLink = pagination.querySelector('.pagination .next a');

            window.addEventListener('scroll', () => {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                    if (nextLink) {
                        window.location.href = nextLink.href;
                    }
                }
            });
        });
    </script>
    
</x-layout>