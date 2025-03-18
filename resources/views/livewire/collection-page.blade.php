<section>
    <div class="px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-1 gap-y-8">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
</section>
