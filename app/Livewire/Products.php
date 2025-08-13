<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Products extends Component
{
    use WithPagination;
     use AuthorizesRequests;
    

    public $perPage = 10;
    public $search= '' ;   
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    protected $paginationTheme = 'tailwind'; 


    public function updatedSearch()
    {
        $this->resetPage();
    }

  public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function sortByCell($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }

     public function delete($id)
    {
        $this->authorize('delete', Product::class);
        $product = Product::findOrFail($id);
        if ($product->image_path && file_exists(storage_path('app/public/' . $product->image_path))) {
            unlink(storage_path('app/public/' . $product->image_path));
        }

        $product->delete();

        session()->flash('message', 'Product deleted successfully.');
    }

    public function render()
    {
        
        $query = Product::query()->with('category');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->orWhere('products.name', 'like', '%' . $this->search . '%')
                    ->orWhere('products.price', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($qRel) {
                        $qRel->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->sortField) {
            if (Str::contains($this->sortField, '.')) {
             
                [$relation, $relColumn] = explode('.', $this->sortField, 2);
                
                if ($relation === 'category') {
                    $query->join('categories', 'products.category_id', '=', 'categories.id')
                          ->orderBy('categories.' . $relColumn, $this->sortDirection)
                          ->select('products.*');
                } else {
                    $query->join($relation, function($join) use ($relation) {
                        $join->on('products.' . $relation . '_id', '=', $relation . '.id');
                    })->orderBy($relation . '.' . $relColumn, $this->sortDirection)
                      ->select('products.*');
                }
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }
        }

        return view('livewire.products', [
            'products' => $query->paginate($this->perPage),
        ])
            ->layout('components.layouts.app', ['title' => __('Products')]);
    }
}
