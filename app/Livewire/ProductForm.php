<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId;
    public $name, $price, $category_id, $stock, $description, $image_path, $image_preview;

    public function mount($id = null)
    {
        if ($id) {
            $product = Product::findOrFail($id);
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->price = $product->price;
            $this->category_id = $product->category_id;
            $this->stock = $product->stock;
            $this->description = $product->description;
            $this->image_preview = $product->image_path ? asset('storage/' . $product->image_path) : null;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:products,name,' . $this->productId,
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image_path' => $this->productId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        if ($this->image_path) {
            $path = $this->image_path->store('products', 'public');
        }

        Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'stock' => $this->stock,
                'description' => $this->description,
                'image_path' => $path ?? $this->image_preview,
            ]
        );

        session()->flash('message', 'Product saved successfully.');
        return redirect()->route('products');
    }

    public function render()
    {
        return view('livewire.product-form', [
            'categories' => Category::all(),
        ]);
    }
}

