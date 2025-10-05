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

    <!-- Contact Info Section -->
    <div class="max-w-3xl mx-auto text-center mb-16">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Get in Touch Directly</h3>
            <p class="text-gray-600 mb-4">You can also reach us via phone or email:</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-lg">
                <a href="mailto:info@hayink.com" class="text-blue-600 hover:underline">
                    info@hayink.com
                </a>
                <span class="hidden sm:inline text-gray-400">•</span>
                <a href="tel:+37499390929" class="text-blue-600 hover:underline">
                    +374&nbsp;99&nbsp;249092
                </a>
            </div>
        </div>
    </div>
</div>
