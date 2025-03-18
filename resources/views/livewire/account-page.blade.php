<div class="flex w-full justify-center">
    <main class="p-6 max-w-7xl">
        <h2 class="text-2xl font-semibold text-gray-700">Designer Dashboard</h2>

        <!-- Stats Cards -->
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Total Sales Card -->
            <div class="p-5 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg">
                <h3 class="text-sm font-medium">Total Sales</h3>
                <p class="text-3xl font-bold">$2,340</p>
                <p class="text-sm mt-1 opacity-80">Compared to last month: <span class="font-semibold">+15%</span></p>
            </div>

            <!-- Earnings Card -->
            <div class="p-5 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-lg shadow-lg">
                <h3 class="text-sm font-medium">Earnings</h3>
                <p class="text-3xl font-bold">$1,200</p>
                <p class="text-sm mt-1 opacity-80">Pending Payouts: <span class="font-semibold">$150</span></p>
            </div>

            <!-- Orders Card -->
            <div class="p-5 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg shadow-lg">
                <h3 class="text-sm font-medium">Orders</h3>
                <p class="text-3xl font-bold">32</p>
                <p class="text-sm mt-1 opacity-80">New orders today: <span class="font-semibold">5</span></p>
            </div>
        </div>


        <!-- My Designs -->
        <div class="mt-6 bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">My Designs</h3>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">
                <div class="p-3 border rounded-lg">
                    <img src="{{ config('app.url') . '/storage/shirt-1.webp' }}" class="w-full h-40 object-cover rounded">
                    <p class="mt-2 text-sm text-gray-700">Cool Streetwear Tee</p>
                    <button class="mt-2 px-4 py-2 text-xs bg-blue-600 text-white rounded-lg">Edit</button>
                </div>
                <div class="p-3 border rounded-lg">
                    <img src="{{ config('app.url') . '/storage/shirt-2.webp' }}" class="w-full h-40 object-cover rounded">
                    <p class="mt-2 text-sm text-gray-700">Minimalist Design</p>
                    <button class="mt-2 px-4 py-2 text-xs bg-blue-600 text-white rounded-lg">Edit</button>
                </div>
                <div class="p-3 border rounded-lg">
                    <img src="{{ config('app.url') . '/storage/shirt-3.webp' }}" class="w-full h-40 object-cover rounded">
                    <p class="mt-2 text-sm text-gray-700">Typography Tee</p>
                    <button class="mt-2 px-4 py-2 text-xs bg-blue-600 text-white rounded-lg">Edit</button>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="mt-6 bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Recent Orders</h3>
            <table class="w-full mt-4 text-sm">
                <thead>
                <tr class="border-b">
                    <th class="py-2 text-left">Product</th>
                    <th class="py-2 text-left">Date</th>
                    <th class="py-2 text-left">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b">
                    <td class="py-2">Cool Streetwear Tee</td>
                    <td class="py-2">Feb 20, 2025</td>
                    <td class="py-2 text-green-600">Shipped</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2">Minimalist Design</td>
                    <td class="py-2">Feb 18, 2025</td>
                    <td class="py-2 text-yellow-600">Pending</td>
                </tr>
                <tr>
                    <td class="py-2">Typography Tee</td>
                    <td class="py-2">Feb 15, 2025</td>
                    <td class="py-2 text-red-600">Canceled</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
