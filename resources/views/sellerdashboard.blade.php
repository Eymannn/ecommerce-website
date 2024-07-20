<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SELLER') }}
        </h2>
        <a href="/add/product"><button class="px-4 p-2 bg-emerald-100 rounded-lg">
            Add new product
        </button></a>
        </div>
    </x-slot>
    <section class="text-center justify-center items-center"> 
        <div class="text-center justify-center items-center">
            <table class="min-w-full table-auto">
               <thead><tr>Products</tr></thead>
              <thead class="justify-between">
               
                    
                
                <tr class="bg-gray-800">
                  <th class="px-16 py-2">
                    <span class="text-gray-300">image</span>
                  </th>
                  <th class="px-16 py-2">
                    <span class="text-gray-300">Name</span>
                  </th>
                  <th class="px-16 py-2">
                    <span class="text-gray-300">Price</span>
                  </th>
                  <th class="px-16 py-2">
                    <span class="text-gray-300">category</span>
                  </th>
                  <th class="px-16 py-2">
                    <span class="text-gray-300">Delete</span>
                  </th>
                
              </thead>

              <tbody class="bg-gray-200">
                @foreach ($products as $product)
                <tr class="bg-white border-4 border-gray-200">
                  <td class="px-16 py-2 flex flex-row items-center">
                    <img
                      class="h-8 w-8 rounded-full object-cover "
                      src="{{$product->getFirstMediaUrl('products')}}"
                      alt=""
                    />
                  </td>
                  <td>
                    <span class="text-center ml-2 font-semibold">{{$product->name }}</span>
                  </td>
                  <td class="px-16 py-2">
                    <span class="text-center ml-2 font-semibold">{{ $product->price }}</span>
                  </td>
                  <td class="px-16 py-2">
                    <span>{{ $product->category }}</span>
                  </td>
                  <td class="px-16 py-2 text-center">

                    <form action="{{ route('delete.product', ['id' => $product->id] ) }}" method="POST">
                      @method('DELETE')
                      @csrf
                <button type="submit"><span class="text-center ml-2 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>                  
                        </span></button>

                    </form>
                        
                  </td>
                  
                  </tr> 
                @endforeach   
              </tbody>
            </table>
          </div>
    </section>

  
</x-app-layout>
