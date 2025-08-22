<div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-whitep-6 mt-10 mb-10">

            <h2 class="text-2xl font-semibold mb-4">Submit Your Design</h2>
            <div>
                <form wire:submit.prevent="submit" class="space-y-6" enctype="multipart/form-data">
                    {{ $this->form }}

                    <div class="flex justify-end">
                        <x-filament::button type="submit" color="gray">
                            Submit
                        </x-filament::button>
                    </div>
                </form>

                @if (session()->has('success'))
                    <div class="text-green-600 mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>


        </div>

    </div>
</div>
