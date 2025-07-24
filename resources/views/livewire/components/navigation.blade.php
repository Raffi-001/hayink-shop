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

            <nav class="hidden lg:gap-4 lg:flex lg:ml-8">
                @foreach ($this->collections as $collection)
                    <a class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3"
                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                       wire:navigate
                    >
                        {{ $collection->translateAttribute('name') }}
                    </a>
                @endforeach
                    <a class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3"
                       href="{{ route('pages.artists') }}"
                       wire:navigate
                    >
                        Meet the Artists
                    </a>
                    <a class="text-sm font-medium transition hover:opacity-75 uppercase hover:bg-primary-200 p-3"
                       href="{{ route('pages.services') }}"
                       wire:navigate
                    >
                        Services
                    </a>

            </nav>
        </div>

        <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end">

            <a href="{{ route('apply-as-an-artist.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4">
                Apply as an Artist
            </a>

            <a href="{{ route('create-your-own.view') }}" type="submit" class="px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4">
                Create Your Own Product
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
