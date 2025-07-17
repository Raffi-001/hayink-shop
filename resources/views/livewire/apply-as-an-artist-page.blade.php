<div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-whitep-6 mt-10 mb-10">
            <h2 class="text-2xl font-semibold mb-4">Apply as an Artist</h2>
            <div class="mb-4 border rounded-lg p-4">
                Share your unique t-shirt designs with the world.
                Earn money every time your art gets sold.
            </div>
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

                <div class="border rounded-lg p-4 bg-primary-50/50 flex flex-col gap-4">
                <!-- Portfolio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Portfolio URL</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        <dev class="text-xs">Behance, Instagram, personal site, etc.</dev>
                    </div>

                    <!-- Design File -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="design">Upload a Sample of Your Design</label>
                        <input type="file" id="design" name="design" accept=".png, .jpg, .jpeg, .svg, .pdf" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 bg-white" />
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: PNG, JPG, SVG, PDF. Max size: 10MB.</p>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">Tell Us About Yourself as an Artist</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    <p class="text-xs text-gray-500 mt-1">This text will be used publicly as your Artist biography.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">What Kind of Designs Do You Create?</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="country">Country of Residence</label>
                    <select id="country" name="country" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select your country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="UK">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="DE">Germany</option>
                        <option value="FR">France</option>
                        <option value="IN">India</option>
                        <option value="JP">Japan</option>
                        <option value="BR">Brazil</option>
                        <option value="NG">Nigeria</option>
                        <option value="PH">Philippines</option>
                        <option value="AR">Argentina</option>
                        <option value="EG">Egypt</option>
                        <option value="AM">Armenia</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
