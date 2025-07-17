<div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-whitep-6 mt-10 mb-10">
            <h2 class="text-2xl font-semibold mb-4">Apply as an Artist</h2>
            <div class="mb-4 border rounded-lg p-4">
                Share your unique t-shirt designs with the world.
                Earn money every time your art gets sold.
            </div>
            <form wire:submit.prevent="submit">

            {{ $this->form }}
            </form>

        </div>

    </div>
</div>
