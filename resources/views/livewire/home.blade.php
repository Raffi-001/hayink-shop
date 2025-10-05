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


                    <div x-data="carousel({ total: {{ $collection->products->count() }}, perView: 5 })" class="relative mt-8">
                        <!-- Carousel container -->
                        <div class="overflow-hidden">
                            <div class="flex transition-transform duration-300"
                                 :style="'transform: translateX(-' + (currentIndex * (100 / perView)) + '%)'">
                                @foreach ($collection->products as $product)
                                    <div class="flex-shrink-0 w-1/2 lg:w-1/5 p-1">
                                        <x-product-card :product="$product" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Previous button -->
                        <button @click="prev"
                                class="absolute top-1/2 left-0 -translate-y-1/2 bg-white rounded-full shadow p-2 hover:bg-gray-100">
                            &#10094;
                        </button>

                        <!-- Next button -->
                        <button @click="next"
                                class="absolute top-1/2 right-0 -translate-y-1/2 bg-white rounded-full shadow p-2 hover:bg-gray-100">
                            &#10095;
                        </button>
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

    <div class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- CTA 1 -->
            <div class="relative aspect-square overflow-hidden">
                <img
                    src="/images/front-sections-1.png"
                    alt="Limited Edition Drops"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="absolute bottom-0 left-0 z-10 text-white w-full p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-accent">Limited Edition Drops</h2>
                            <p class="text-md">
                                One-of-a-kind fashion pieces from silk scarves and linen shirts to bold kimonos...
                            </p>
                        </div>
                        <a href="/collections/t-shirts"
                           class="shrink-0 px-4 py-2 text-sm font-medium text-center text-white border border-white/70 hover:border-white hover:bg-white/10 rounded-md transition-all whitespace-nowrap">
                            View Collection
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA 2 -->
            <div class="relative aspect-square overflow-hidden">
                <img
                    src="/images/front-sections-2.png"
                    alt="Premium Merch for Your Business"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="absolute bottom-0 left-0 z-10 text-white w-full p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-accent">Premium Merch for Your Business</h2>
                            <p class="text-md">
                                Custom apparel your team will actually want to wear. High-quality prints, premium fabrics, and tailored designs for companies, studios, and organizations in Armenia.
                            </p>
                        </div>
                        <a href="/services"
                           class="shrink-0 px-4 py-2 text-sm font-medium text-center text-white border border-white/70 hover:border-white hover:bg-white/10 rounded-md transition-all whitespace-nowrap">
                            More About Our Services
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA 3 -->
            <div class="relative aspect-square overflow-hidden">
                <img
                    src="/images/front-sections-3.png"
                    alt="Make Your Own Design"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="absolute bottom-0 left-0 z-10 text-white w-full p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-accent">Make Your Own Design</h2>
                            <p class="text-md">
                                Your idea, your print. Upload your design and we’ll craft it on premium t-shirts, hoodies, and more — made locally, just for you.
                            </p>
                        </div>
                        <a href="/create-your-own-product"
                           class="shrink-0 px-4 py-2 text-sm font-medium text-center text-white border border-white/70 hover:border-white hover:bg-white/10 rounded-md transition-all whitespace-nowrap">
                            Custom Products
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA 4 -->
            <div class="relative aspect-square overflow-hidden">
                <img
                    src="/images/front-sections-4.png"
                    alt="Become a Creator with Us"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="absolute bottom-0 left-0 z-10 text-white w-full p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-accent">Become a Creator with Us</h2>
                            <p class="text-md">
                                Turn your art into wearable merch. We partner with Armenian artists and creators, bringing their designs to life on premium apparel and helping them sell globally.
                            </p>
                        </div>
                        <a href="/apply-as-an-artist"
                           class="shrink-0 px-4 py-2 text-sm font-medium text-center text-white border border-white/70 hover:border-white hover:bg-white/10 rounded-md transition-all whitespace-nowrap">
                            Apply as an Artist
                        </a>
                    </div>
                </div>
            </div>
        </div>





    </div>

    <div class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="sm:flex sm:items-baseline sm:justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Artists
            </h2>
            <a href="/artists" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                Browse all
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

    <section class="pt-8 flex gap-8 bg-white max-w-full mx-auto">
        @foreach ($this->artists as $collection)
            <div>
                <a href="/collections/{{ $collection->translateAttribute('name') }}">
                    <div class="flex flex-col gap-4 border border-primary-200 p-4">
                        <div>
                            <img src="/storage/{{ $collection->translateAttribute('profile-photo') }}" class="max-w-40 max-h-40 rounded-full"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="text-center font-bold">
                                {{ $collection->translateAttribute('name') }} <br />
                            </div>
                            <div class="text-center text-sm">
                                {{ $collection->products->count() }} Designs
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </section>
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




    <script>
        function carousel({ total, perView }) {
            return {
                currentIndex: 0,
                total,
                perView,
                prev() {
                    this.currentIndex = Math.max(this.currentIndex - 1, 0);
                },
                next() {
                    this.currentIndex = Math.min(this.currentIndex + 1, this.total - this.perView);
                },
            }
        }
    </script>


</div>


