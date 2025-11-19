<header class="relative border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-full sm:px-6 lg:px-8">
        <div class="flex items-center h-full">
            <a class="flex items-center flex-shrink-0"
               href="{{ url('/') }}"
               wire:navigate
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600" />
            </a>

            <nav class="hidden lg:flex lg:ml-8 lg:gap-4 relative">
                <!-- Collections Dropdown -->
                <div class="relative group">
                    <button
                        class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3 flex items-center gap-1"
                    >
                        {{ __('livewire.components.navigation.shop') }}
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute left-0 mt-2 w-72 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 z-50"
                    >
                        <a href="/product-all"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-200 uppercase"
                        >
                            All
                        </a>

                        @foreach($this->productTypes as $type)
                        <a href="/product-types/{{ $type->id }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-200 uppercase"
                        >
                            {{ $type->name }}
                        </a>
                        @endforeach
                        <!--
                        <a href="/collections/t-shirts"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-200 uppercase"
                        >
                            T-shirts
                        </a>

                            <a href="/collections/scarves"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-200 uppercase"
                            >
                                Scarves
                            </a>

                            <a href="#"
                               class="block px-4 py-2 text-sm text-gray-400 hover:bg-primary-200 uppercase"
                            >
                                Hoodies <span class="text-xs">(coming soon)</span>
                            </a>

                            <a href="#"
                               class="block px-4 py-2 text-sm text-gray-400 hover:bg-primary-200 uppercase"
                            >
                                Limited Editions <span class="text-xs">(coming soon)</span>
                            </a>
                            -->
                    </div>
                </div>

                <!-- Other links -->
                <a class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3"
                   href="{{ route('pages.artists') }}"
                   wire:navigate
                >
                    {{ __('livewire.components.navigation.meet-the-artists') }}
                </a>
                <a class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3"
                   href="{{ route('pages.services') }}"
                   wire:navigate
                >
                    {{ __('livewire.components.navigation.services') }}
                </a>
            </nav>

        </div>

        <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end">
            <div class="lg:hidden">&nbsp;</div>

            <livewire:components.language-switcher />

            <a href="{{ route('apply-as-an-artist.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4 hidden lg:inline-block">
                {{ __('livewire.components.navigation.apply-as-an-artist') }}
            </a>

            <a href="{{ route('create-your-own.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4 hidden lg:inline-block">
                {{ __('livewire.components.navigation.create-your-product') }}
            </a>

            @if(false)
            <x-header.search class="max-w-sm mr-4" />
            @endif

            <div class="flex items-center -mr-4 sm:-mr-6 lg:mr-0">
                @livewire('components.cart')



                <div x-data="{ mobileMenu: false }">
                    <button x-on:click="mobileMenu = !mobileMenu"
                            class="grid flex-shrink-0 w-16 h-16 border-l border-gray-100 lg:hidden">
                        <span class="sr-only">Toggle Menu</span>

                        <span class="place-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </span>
                    </button>

                    <div x-cloak
                         x-transition
                         x-show="mobileMenu"
                         class="absolute right-0 top-auto z-50 w-screen p-4 sm:max-w-xs">
                        <ul x-on:click.away="mobileMenu = false"
                            class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl rounded-xl">
                            @foreach ($this->collections as $collection)
                                <li>
                                    <a class="text-sm font-medium"
                                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                                       wire:navigate
                                    >
                                        {{ $collection->translateAttribute('name') }}
                                    </a>
                                </li>
                            @endforeach
                                <li>
                                    <a class="text-sm font-medium"
                                       href="{{ route('pages.artists') }}"
                                       wire:navigate
                                    >
                                        Meet the Artists
                                    </a>
                                </li>
                                <li>
                                    <a class="text-sm font-medium"
                                       href="{{ route('pages.services') }}"
                                       wire:navigate
                                    >
                                        Services
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('apply-as-an-artist.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4">
                                        Apply as an Artist
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('create-your-own.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4">
                                        Create Your Own Product
                                    </a>
                                </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
