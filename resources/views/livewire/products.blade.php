<div>
    @if (session()->has('message'))
        <div id="flashMessage"
            class="fixed top-4 right-4 bg-green-100 text-green-800 px-4 py-2 rounded shadow-lg flex items-center justify-between gap-3">
            <span>{{ session('message') }}</span>
            <button onclick="document.getElementById('flashMessage').remove()"
                class="text-green-800 hover:text-green-600">
                ✕
            </button>
        </div>

        <script>
            setTimeout(() => {
                const flashMessage = document.getElementById('flashMessage');
                if (flashMessage) {
                    flashMessage.remove();
                }
            }, 3000);
        </script>
    @endif


    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Products</h1>
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Product
            </a>
        @endif

    </div>
    <div>
        <div class="flex justify-between items-center mb-3">
            <input type="text" wire:model.live.debounce.300ms="search" class="border rounded px-3 py-2 w-1/3"
                placeholder="Search...">

            <select wire:model.live="perPage" class="border rounded px-2 py-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
        </div>

        <table class="w-full border border-gray-300">
            <thead class="bg-transparent">
                <tr>
                    <th class="border px-3 py-2 cursor-pointer  select-none transition-colors duration-150"
                        wire:click="sortBy('id')">
                        <div class="flex items-center justify-between">
                            <span>ID</span>
                            <div class="ml-2">
                                @if ($sortField === 'id')
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                    <th class="border px-3 py-2 cursor-pointer  select-none transition-colors duration-150"
                        wire:click="sortBy('name')">
                        <div class="flex items-center justify-between">
                            <span>Name</span>
                            <div class="ml-2">
                                @if ($sortField === 'name')
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                    <th class="border px-3 py-2 cursor-pointer select-none transition-colors duration-150">
                        <span>Picture</span>
                    </th>
                    <th class="border px-3 py-2 cursor-pointer  select-none transition-colors duration-150"
                        wire:click="sortBy('price')">
                        <div class="flex items-center justify-between">
                            <span>Price</span>
                            <div class="ml-2">
                                @if ($sortField === 'price')
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                    <th class="border px-3 py-2 cursor-pointer  select-none transition-colors duration-150"
                        wire:click="sortBy('stock')">
                        <div class="flex items-center justify-between">
                            <span>Stock</span>
                            <div class="ml-2">
                                @if ($sortField === 'stock')
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                    <th class="border px-3 py-2 cursor-pointer select-none transition-colors duration-150"
                        wire:click="sortBy('category.name')">
                        <div class="flex items-center justify-between">
                            <span>Category</span>
                            <div class="ml-2">
                                @if ($sortField === 'category.name')
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                    @if (auth()->user()->role === 'admin')
                        <th class="border px-3 py-2 cursor-pointer select-none transition-colors duration-150">
                            <span>Action</span>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="border px-3 py-2 cursor-pointer  transition-colors duration-150"
                            wire:click="sortByCell('id')">
                            {{ $product->id }}
                        </td>

                        <td class="border px-3 py-2 cursor-pointer  transition-colors duration-150"
                            wire:click="sortByCell('name')">
                            {{ $product->name }}
                        </td>
                        <td class="border px-3 py-2 cursor-pointer  transition-colors duration-150">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 cursor-pointer  transition-colors duration-150"
                            wire:click="sortByCell('price')">
                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="border px-3 py-2 cursor-pointer text-center transition-colors duration-150"
                            wire:click="sortByCell('stock')">
                            @if ($product->stock > 10)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @elseif($product->stock < 10 && $product->stock > 0)
                                <span class="bg-amber-100 text-amber-500 px-2 py-1 rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="bg-red-100 text-red-500 px-2 py-1 rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 cursor-pointer  transition-colors duration-150">
                            {{ $product->category->name ?? '-' }}
                        </td>
                        @if (auth()->user()->role === 'admin')
                            <td class="border px-3 py-2 text-center">
                                <div class="">
                                    <div class="flex justify-center space-x-3 items-center">

                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-blue-500 hover:text-blue-700 transition-colors bg-transparent border shadow rounded-lg p-2 inline-block"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l10.932-10.931zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>

                                        <button wire:click="delete({{ $product->id }})"
                                            class="text-red-500 hover:text-red-700 transition-colors bg-transparent border shadow rounded-lg p-2 inline-block"
                                            title="Delete">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-gray-500">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

</div>
