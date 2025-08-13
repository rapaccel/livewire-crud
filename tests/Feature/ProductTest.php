<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_products_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
             ->get('/products')
             ->assertStatus(200)
             ->assertSeeLivewire('products'); 
    }



}
