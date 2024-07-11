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
    <section>
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
                </tr> 
                @endforeach   
              </tbody>
            </table>
          </div>
    </section>

  
</x-app-layout>
