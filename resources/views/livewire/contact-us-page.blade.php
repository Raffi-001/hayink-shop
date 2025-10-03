<div>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white p-6 mt-10 mb-10 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Contact Us</h2>
            <div class="mb-4 text-gray-600">
                Have a question or comment? Send us a message and we’ll get back to you.
            </div>
            <form wire:submit.prevent="submit">
                {{ $this->form }}

                <div class="mt-4">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
