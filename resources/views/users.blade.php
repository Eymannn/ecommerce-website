<x-layout>
    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                href="#">
                USERS
            </a>
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                href="/admin">
                ADMIN
            </a>
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                href="/archive">
                ARCHIVED
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
    <!-- ====== Table Section Start -->
    <section class="bg-white dark:bg-dark ">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div class="max-w-full overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="text-center bg-[#75849a]">
                                    <th
                                        class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        username
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        email
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        status
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        actions
                                    </th>
                                    <th  class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        UserType

                                    </th>
                                    <th  class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">
                                        Roles

                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($users as $user)
                                                        
                                    <tr class="text-center items-center border-b border-lime-600">
                                        <td class=" py-3">
                                            {{ $user->name }}
                                        </td>
                                        <td class=" py-3">
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->userable_type }}
                                        </td>
                                        <td class=" py-3  flex mx-auto justify-center">
                         
                                            <div class=" w-24 text-xs  text-white rounded-xl py-0.5 @switch($user->status)
                                        @case('waiting')
                                        bg-yellow-400
                                        @break
                                        @case('banned')
                                        bg-red-600
                                        @break
                                        @case('verified')
                                        bg-green-600
                                        @break
                                         @default
                                            bg-emerald-300
                                    @endswitch">
                                                
                           {{ $user->status }}
                                        </td>
                                        <td>
                                            <div  class="flex space-x-2 justify-start" >
                                            @if($user->status === 'verified')
                                            <form action="{{ route('ban.user' , ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-1 bg-red-400 rounded-lg text-sm text-white hover:bg-red-600">ban</button>
                                            </form>

                                            @elseif($user->status === 'banned')
                                            
                                            <form action="{{ route('unban.user' , ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-1 bg-red-400 rounded-lg text-xs text-white hover:bg-red-600"> UNBAN</button>
                                            </form>

                                            @else
                                            <form action="{{ route('verify.user' , ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-emerald-400 rounded-lg text-sm text-white hover:bg-emerald-600">verify</button>
                                            </form>
                                            <form action="{{ route('ban.user' , ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-1 bg-red-400 rounded-lg text-sm text-white hover:bg-red-600">ban</button>
                                            </form>
                                            @endif
                                        </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('achivements' , ['id' => $user->id]) }}">
                                                <button class="px-3 py-1 bg-slate-300 text-xs rounded-lg">
                                                    roles
                                                </button>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    
                                @endforeach




                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Table Section End -->
</x-layout>
