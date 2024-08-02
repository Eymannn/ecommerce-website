
<x-layout>
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div class="w-[400px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                    <img class="w-[400px] " src="{{ $product->getFirstMediaUrl('products') }}" alt="Product Image">
                </div>
                <div class="flex -mx-2 mb-4">
                    
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
                <a href="/profile/user/{{ $product->user->id }}">
                <div class="flex space-x-2 mt-3">
                    <img src="{{ $product->user->hasMedia('users') ? $product->user->getMedia('users')->last()->getUrl() : '/images/pp.png'}}" alt="" class="w-10 rounded-full">
                    <div>
                        <span class="text-sm">{{ $product->user->name }}</span>
                        <p class="text-xs tracking-wider text-gray-400">{{ $product->user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
              </a>
                <div class="w-1/2 px-2 mt-8">
                    <form action="{{ route('add.card') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="productId" />
                        
                        <button class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Add to Cart</button>

                        
                        

                    </form>
                </div>
                <div class="w-1/2 px-2 mt-4">
                    <form action="{{ route('add.favorite') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="productId" />
                        
                        <button class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">Add to Wishlist</button>

                        
                        

                    </form>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</div>

{{-- this is the comment section  --}}
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Write a Review</h2>
    <form action="{{ route('add-review') }}" method="POST" class="mb-8" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <input type="text" class="hidden" name="product_id" value="{{ $product->id }}">
            <label for="content" class="block text-sm font-medium text-gray-700">Review Content</label>
            <textarea id="content" name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>
        <div>
            <input type="file" name="image" class="mb-4" > 
        </div>
        <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <div class="mt-1 flex space-x-2">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden" />
                    <label for="rating{{ $i }}" class="cursor-pointer">
                        <svg class="w-8 h-8 text-gray-400 hover:text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049.515L11.277 6.26l5.916.428c.58.042.81.754.392 1.133l-4.573 3.735 1.691 5.777c.168.573-.523.992-.988.682L10 14.183l-4.715 3.732c-.464.31-1.156-.109-.988-.682l1.691-5.777L1.415 7.82c-.418-.38-.188-1.092.392-1.133l5.916-.428L9.049.515a.716.716 0 011.341 0z"></path>
                        </svg>
                    </label>
                @endfor
            </div>
            
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Submit Review</button>
        </div>
    </form>
    <h2 class="text-2xl font-bold mb-4">User Reviews</h2>
    <div class="space-y-4">
        @foreach($reviews as $review)
            <div class="border-b pb-4 mb-4 ">
                <a href="/profile/user/{{ $review->user->id }}" class="hover:text-blue-300"><div class="flex items-center space-x-2">
                    @if($review->user->hasMedia('users'))
                    <img src="{{ $review->user->getMedia('users')->last()->getUrl() }}" alt="" class="w-8 rounded-full"> 
                    @else
                    <img src="/images/pp.png" alt="" class="w-8 rounded-full"> 
                    @endif
                    <p>{{ $review->user->name }}</p>
                </div></a>
                <div class="flex items-center mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049.515L11.277 6.26l5.916.428c.58.042.81.754.392 1.133l-4.573 3.735 1.691 5.777c.168.573-.523.992-.988.682L10 14.183l-4.715 3.732c-.464.31-1.156-.109-.988-.682l1.691-5.777L1.415 7.82c-.418-.38-.188-1.092.392-1.133l5.916-.428L9.049.515a.716.716 0 011.341 0z"></path>
                        </svg>
                    @endfor
                </div>
                <p>{{ $review->content }}</p>

                <img src="{{ $review->getFirstMediaUrl('reviews') }}" alt="" class="w-40">
            </div>
        @endforeach
    </div>
</div>
</x-layout>