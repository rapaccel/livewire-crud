<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductForm extends Component
{
     use AuthorizesRequests;
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

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'image_path' => 'nullable|image|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->authorize('create', Product::class);
        if ($this->productId) {
            $this->authorize('update', Product::findOrFail($this->productId));
        }
        $this->validate([
            'name' => 'required|string|unique:products,name,' . $this->productId,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'image_path' => $this->productId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        if ($this->image_path) {
            $path = $this->image_path->store('products', 'public');
        } else if ($this->productId){
            $product = Product::findOrFail($this->productId);
            $path = $product->image_path;
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

