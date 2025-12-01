<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <!-- Desktop Navbar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left side -->
            <div class="flex items-center">

                <!-- BRAND -->
                <a href="{{ route('catalog') }}"
                   class="text-xl font-extrabold tracking-wide text-[#1F2937] hover:text-[#111827] transition">
                    MEN'S STORE
                </a>

                <!-- Main Nav (Desktop) -->
                <div class="hidden sm:flex sm:ml-10 sm:space-x-8">
                    <x-nav-link :href="route('catalog')" :active="request()->routeIs('catalog')">
                        Каталог
                    </x-nav-link>
                </div>

                <!-- ADMIN menu (Desktop) -->
                @auth
                    @if(Auth::user()->is_admin)
                        <div class="hidden sm:flex sm:ml-6">
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-[#1F2937] transition">
                                        Адмін-панель
                                        <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.06z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.dashboard')">⚙ Адмін-хаб</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.users.index')">👥 Користувачі</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.categories.index')">📁 Категорії</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.products.index')">🛒 Товари</x-dropdown-link>
                                </x-slot>

                            </x-dropdown>

                        </div>
                    @endif
                @endauth

            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <!-- Compare Button -->
<a href="{{ route('compare') }}"
   class="relative mr-4 flex items-center text-gray-700 hover:text-gray-900 transition">

    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M10 6H6v12h4M18 6h-4v12h4" />
    </svg>

    <span class="ml-1 text-sm hidden md:inline">Порівняння</span>
</a>

                <!-- CART BUTTON -->
                <a href="{{ route('cart.index') }}"
                   class="relative flex items-center text-gray-600 hover:text-[#1F2937] transition">

                    <!-- Icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                    </svg>

                    <!-- Counter -->
                    @php $count = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0; @endphp

                    @if($count > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold
                                     rounded-full px-1.5 py-0.5 shadow">
                            {{ $count }}
                        </span>
                    @endif
                </a>
                <!-- END CART BUTTON -->

                @auth
                    <!-- User Menu -->
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-700 hover:text-[#1F2937] transition">

                                <span>{{ Auth::user()->name }}</span>

                                <svg class="ml-2 h-4 w-4 text-gray-500"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Профіль
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Вийти
                                </x-dropdown-link>
                            </form>
                        </x-slot>

                    </x-dropdown>

                @else

                    <a href="{{ route('login') }}"
                       class="text-gray-600 hover:text-[#1F2937] px-4 text-sm transition">Увійти</a>

                    <a href="{{ route('register') }}"
                       class="text-gray-600 hover:text-[#1F2937] px-4 text-sm transition">Реєстрація</a>

                @endauth

            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-500 hover:bg-gray-100 transition">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('catalog')" :active="request()->routeIs('catalog')">
                Каталог
            </x-responsive-nav-link>

            <!-- Cart mobile -->
            <x-responsive-nav-link :href="route('cart.index')">
                🛒 Корзина
            </x-responsive-nav-link>

            @auth
                @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">⚙ Адмін-хаб</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')">👥 Користувачі</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.categories.index')">📁 Категорії</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.products.index')">🛒 Товари</x-responsive-nav-link>
                @endif
            @endauth

        </div>

        <!-- Auth (Mobile) -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">

                <div class="px-4 mb-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <x-responsive-nav-link :href="route('profile.edit')">
                    Профіль
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Вийти
                    </x-responsive-nav-link>
                </form>

            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')">Увійти</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">Реєстрація</x-responsive-nav-link>
            </div>
        @endauth

    </div>

</nav>
