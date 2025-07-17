<div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-whitep-6 mt-10 mb-10">
            <h2 class="text-2xl font-semibold mb-4">Submit Your Design</h2>

            {{ $this->form }}
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Your Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email Address</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Phone Number</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <!-- Design File -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="design">Upload Your Design</label>
                    <input type="file" id="design" name="design" accept=".png, .jpg, .jpeg, .svg, .pdf" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: PNG, JPG, SVG, PDF. Max size: 10MB.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="design">Positioning</label>
                    <div class="flex justify-start flex-wrap gap-8">
                        @foreach($positions as $key => $position)
                            <img
                                src="{{ asset($position['img']) }}"
                                wire:click="togglePosition('{{ $key }}')"
                                class="cursor-pointer border-2 rounded-md transition
                                {{ in_array($key, $selectedPositions) ? 'border-blue-500 ring-2 ring-blue-300' : 'border-transparent' }}"
                            />
                        @endforeach
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">Design Description (optional)</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Submit Design
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
