<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category_id', 'stock', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
