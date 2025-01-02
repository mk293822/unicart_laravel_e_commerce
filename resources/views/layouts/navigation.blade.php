@php

 $cartCount = 0;
 if (!empty(session("cartProducts"))) {
     $cart = session("cartProducts");
     foreach ($cart as $item) {
         $cartCount += $item["quantity"];
     }
 }
@endphp


<nav x-data="{ open: false }" class=" fixed top-0 w-full rounded-b-lg shadow-lg shadow-black/50 flex flex-col gap-0 z-20">
    <div  class="bg-gray-200 border-2 border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center p-0 m-0">
                        <a href="{{ route('dashboard.index') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
    
                    <!-- Navigation Links -->
                    <div class="hidden space-x-4 lg:-my-px lg:ms-5 lg:flex">
                        <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')">
                            {{ __('Orders') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                            {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                            {{ __('Contact') }}
                        </x-nav-link>
                    </div>
                </div>
    
                <div class="flex items-center justify-center w-full ml-8 mr-8">
                    <form action="{{route('dashboard.index')}}" method="get" class="flex items-center gap-0 w-[100%]">
                        <label for="search">
                            <button type="submit" class="h-10 px-2 bg-gray-800 text-white rounded-l-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 1 1 0 14 7 7 0 0 1 0-14zM21 21l-4.35-4.35"></path>
                                </svg>
                            </button>
                        </label>
                        <input type="text" class="px-2 w-full border-none focus:outline-none h-10 outline-none bg-gray-800 text-white rounded-r-lg text-left border-l-0" name="q" placeholder="Search....." >
                    </form>
                </div>
                <!-- Settings Dropdown -->
                <div class="flex gap-4 lg:w-[35rem] mr-0">
                    <a href="{{route('cart.index')}}" class="flex items-center">
                            <x-cart-logo class="block fill-current text-gray-800 font-extrabold" />
                           <p class="rounded-full font-bold text-white w-7 h-7 mb-5 text-sm pt-1 text-center bg-orange-700">{{$cartCount }}</p>
                        </a>
                    <div class="hidden lg:flex lg:items-center lg:gap-4">             
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-white/90 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
        
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
        
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
        
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center lg:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
    
            </div>
        </div>
    
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
            <div class="pt-2 pb-3 space-y-1 order-2">
                <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')">
                    {{ __('Orders') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                    {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>
                
            </div>
    
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 order-1">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
    
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(isset($categories))
        <div class="max-w-7xl p-0 mx-auto lg:px-4 w-full bg-gray-200 border-b-2 border-gray-100 leading-tight">
            <div class="lg:text-sm lg:font-semibold hidden lg:space-x-4 lg:-my-px lg:ms-10 lg:overflow-auto lg:flex text-gray-800">
                <a href="{{route('dashboard.index')}}" class="hover:border-b-2 p-[6px] hover:border-gray-500 cursor-pointer h-8 @if($cate_id == null) font-bold border-b-2 border-gray-800 inline-flex @endif">All</a>    
                @foreach ($categories as $item)
                    <form action="{{route('dashboard.index')}}" method="get">
                      <input type="hidden" name="g" value="{{$item->id}}">
                      <input type="submit" value="{{$item->name}}" class="hover:border-b-2 hover:border-gray-500 cursor-pointer h-8 @if (isset($cate_id))@if($cate_id == $item->id) font-bold border-b-2 border-gray-800 inline-flex @endif @endif"/>
                    </form>
                @endforeach
            </div>
        </div>
    @endif
</nav>