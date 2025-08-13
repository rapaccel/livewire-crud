<div>
    <h1 class="text-2xl font-bold mb-4">Product Form</h1>
    <form wire:submit.prevent="save" class="space-y-4 ">

        <div>
            <label>Name</label>
            <input type="text" wire:model="name" class="border rounded px-3 py-2 w-full">
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Price</label>
            <input type="number" wire:model="price" step="0.01" class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label>Category</label>
            <select wire:model="category_id" class="border rounded px-3 py-2 w-full">
                <option value="">-- Select --</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Stock</label>
            <input type="number" wire:model="stock" class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label>Description</label>
            <textarea wire:model="description" class="border rounded px-3 py-2 w-full"></textarea>
        </div>

        <div>
            <label>Image</label>
            <input type="file" wire:model="image_path" class="border rounded px-3 py-2 w-full">
            @if ($image_path)
                <img src="{{ $image_path->temporaryUrl() }}" class="w-32 h-32 mt-2 object-cover">
            @elseif ($image_preview)
                <img src="{{ $image_preview }}" class="w-32 h-32 mt-2 object-cover">
            @endif

            @error('image_path')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
