<div>
    <x-welcome-banner />



    <div class="pt-16">
    @if (data_get($this, 'frontPageCollections'))
        @foreach($this->frontPageCollections as $collection)
            <section class="bg-white">
                <div class="px-4 sm:px-6 lg:px-8 pb-16">
                    <div class="sm:flex sm:items-baseline sm:justify-between">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                            {{ $collection->translateAttribute('name') }}
                        </h2>
                        <a href="/collections/{{ $collection->defaultUrl->slug }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                            Browse all
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-2 mt-8 lg:grid-cols-5 gap-x-1 gap-y-8">
                        @foreach ($collection->products->take(4) as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-6 sm:hidden">
                        <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                            Browse all
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    </div>





    @if(false)
    <section aria-labelledby="collections-heading">
        <div class="">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <h2 id="collections-heading" class="text-2xl font-bold text-gray-900">
                    <marquee class="uppercase">More Collections</marquee>
                </h2>

                <div class="mt-3 space-y-12 lg:grid lg:grid-cols-3 lg:space-y-0">
                    <article class="group relative">
                        <div class="relative h-80 w-full overflow-hidden rounded-lg lg:rounded-none bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64 md:h-128">
                            <img src="images/men-6.jpg" alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." class="h-full w-full object-cover object-center" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                            <h3 class="absolute bottom-4 w-full text-center text-lg text-white">
                                <a href="#" class="relative">
                                    <span class="absolute inset-0"></span>
                                    Luxury Hoodies
                                </a>
                            </h3>
                        </div>
                    </article>
                    <article class="group relative">
                        <div class="relative h-80 w-full overflow-hidden rounded-lg lg:rounded-none bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64 md:h-128">
                            <img src="images/men-1.jpg" alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." class="h-full w-full object-cover object-center" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                            <h3 class="absolute bottom-4 w-full text-center text-lg text-white">
                                <a href="#" class="relative">
                                    <span class="absolute inset-0"></span>
                                    Premium Suits
                                </a>
                            </h3>
                        </div>
                    </article>
                    <article class="group relative">
                        <div class="relative h-80 w-full overflow-hidden rounded-lg lg:rounded-none bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64 md:h-128">
                            <img src="images/men-5.jpg" alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." class="h-full w-full object-cover object-center" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                            <h3 class="absolute bottom-4 w-full text-center text-lg text-white">
                                <a href="#" class="relative">
                                    <span class="absolute inset-0"></span>
                                    Exclusive T-Shirts
                                </a>
                            </h3>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>




    <x-collection-sale />

    <x-testimonials />

    @endif





</div>


