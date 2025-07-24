<section>
    <div class="px-4 pb-16 sm:px-6 sm:pb-20 lg:px-8">
        <div class="flex gap-8 bg-blue-50 p-8">
            @if($this->collection->translateAttribute('profile-photo'))
            <div class="">
                <img src="/storage/{{ $this->collection->translateAttribute('profile-photo') }}" class="max-w-40 rounded-full"/>
            </div>
            @endif
            <div class="flex flex-col gap-8">

                <h1 class="text-3xl font-bold">
                    {{ $this->collection->translateAttribute('name') }}
                </h1>

                <div class="">
                    {!! $this->collection->translateAttribute('description') !!}
                </div>

            </div>
        </div>

        <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-1 gap-y-8">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>

    </div>
</section>
