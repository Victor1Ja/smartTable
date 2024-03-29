<nav x-data="{ mobile_menu_visible: false }" class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @foreach($menu_items as $item)
                        @if(request()->routeIs($item['route']))
                        <a href="{!! $item['url'] ?? route($item['route']) !!}" class="text-white font-medium px-3 py-2 bg-gray-900 rounded-md focus:outline-none focus:text-white focus:bg-gray-700" aria-current="page">{{$item['label']}}</a>
                        @else
                        <a href="{!! $item['url'] ?? route($item['route']) !!}" class="text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md font-medium">{{$item['label']}}</a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Notifications button -->
                    <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>
                    @auth
                    <livewire:cart-component />
                    @endauth
                    @guest
                    <!-- Shopping cart -->
                    <!-- Profile dropdown -->
                    <div class="text-white">
                        <a href="{{route('register')}}" class="uppercase py-.5 px-2">Register</a>
                    </div>
                    <div class="text-white">
                        <a href="{{route('login')}}" class="border border-white uppercase py-.5 px-2">LOGIN</a>
                    </div>
                    @endguest

                    @auth
                    <div class="relative ml-3 " x-data="{ admin_menu_visible: false }">
                        <!-- Profile image button -->
                        <button @click="admin_menu_visible = !admin_menu_visible" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="admin_menu_visible" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            @auth
                            <span class="block px-4 py-2 text-xs uppercase text-gray-400 font-semibold">My data</span>
                            @foreach($home_menu_items as $item)
                            @if(request()->routeIs($item['route']))
                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 pt-2 text-sm bg-gray-100 text-gray-700" role="menuitem" tabindex="-1">{{$item['label']}}</a>
                            @else
                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">{{$item['label']}}</a>
                            @endif
                            @endforeach
                            <hr class="mt-2">
                            @endauth

                            @if(auth()->user()->is_admin)
                            <span class="block px-4 py-2 text-xs uppercase text-gray-400 font-semibold">Manage data</span>
                            @foreach($admin_menu_items as $item)
                            @if(request()->routeIs($item['route']))
                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 pt-2 text-sm bg-gray-100 text-gray-700" role="menuitem" tabindex="-1">{{$item['label']}}</a>
                            @else
                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">{{$item['label']}}</a>
                            @endif
                            @endforeach
                            <hr class="mt-2">
                            @endif

                            <!--route('profile.edit') -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Your profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>

                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" onclick="event.preventDefault(); this.closest('form').submit();">Sign out</a>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button @click="mobile_menu_visible = !mobile_menu_visible" type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden" id="mobile-menu" x-show="mobile_menu_visible">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            @foreach($menu_items as $item)
            @if(request()->routeIs($item['route']))
            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium text-white bg-gray-900" aria-current="page">{{$item['label']}}</a>
            @else
            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{$item['label']}}</a>
            @endif
            @endforeach
        </div>

        <!-- Mobile user info -->
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                    <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                </div>
                <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
            </div>

            <!-- Mobile user menu -->
            <div class="mt-3 space-y-1 px-2">
                @foreach($admin_menu_items as $item)
                @if(request()->routeIs($item['route']))
                <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium text-white bg-gray-900 hover:text-white">{{$item['label']}}</a>
                @else
                <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">{{$item['label']}}</a>
                @endif
                @endforeach
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
            </div>
        </div>
    </div>
</nav>