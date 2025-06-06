<div>
    <div class="flex gap-4">
        <div>
            <label for="quantity"
                   class="sr-only">
                Quantity
            </label>

            <input class="w-16 px-1 py-4 text-sm text-center transition border border-gray-100 focus:border-primary-500 focus:ring-primary-500 no-spinner"
                   type="number"
                   id="quantity"
                   min="1"
                   value="1"
                   wire:model.live="quantity" />
        </div>

        <button type="submit"
                class="w-full px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600"
                wire:click.prevent="addToCart">
            Add to Cart
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
             role="alert">
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
