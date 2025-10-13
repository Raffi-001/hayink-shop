<section>
    <div class="px-4 pb-16 sm:px-6 sm:pb-20 lg:px-8">
        <h2 class="text-4xl pt-8">{{ $this->title }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 mt-8 lg:grid-cols-3 xl:grid-cols-4 gap-x-1 gap-y-8">
            @forelse($this->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>

    </div>
</section>
