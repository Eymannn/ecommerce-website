
<x-layout>
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div class="w-[400px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                    <img class="w-[400px]8 " src="{{ $product->getFirstMediaUrl('products') }}" alt="Product Image">
                </div>
                <div class="flex -mx-2 mb-4">
                    <div class="w-1/2 px-2">
                        <form action="{{ route('add.card') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="productId" />
                            
                            <button class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Add to Cart</button>

                            
                            

                        </form>
                    </div>
                    <div class="w-1/2 px-2">
                        <form action="{{ route('add.favorite') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="productId" />
                            
                            <button class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">Add to Wishlist</button>

                            
                            

                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $product->name }}</h2>
                
                <div class="flex mb-4">
                    <div class="mr-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                        <span class="text-gray-600 dark:text-gray-300">£ {{ $product->price }}</span>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                        <span class="text-gray-600 dark:text-gray-300">In Stock</span>
                    </div>
                </div>
                
                
                <div>
                    <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                     {{$product->big_desc}}  </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>