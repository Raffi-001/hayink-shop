<section>
    <div class="px-4 pb-16 sm:px-6 sm:pb-20 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8 bg-blue-50 p-8 items-start">
            @if(data_get($this, 'designer.image'))
                <div class="w-20 h-20 md:w-40 md:h-40 rounded-full bg-white overflow-hidden flex items-center justify-center shrink-0">
                    <img
                        src="{{ data_get($this, 'designer.image') }}"
                        class="object-cover"
                        alt="Designer Image"
                    />
                </div>
            @endif

            <div class="flex flex-col gap-2 md:gap-8">
                <h1 class="text-xl md:text-3xl font-bold">
                    {{ $this->collection->translateAttribute('name') }}
                </h1>

                <div>
                    {!! data_get($this, 'designer.about') !!}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 mt-8 lg:grid-cols-3 xl:grid-cols-4 gap-x-1 gap-y-8">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
</section>

