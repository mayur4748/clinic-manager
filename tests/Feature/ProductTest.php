<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test product creation
     */
    public function test_product_can_be_created(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post('/products', [
                'category' => 'Medicine',
                'subcategory' => 'Tablet',
                'product_name' => 'Paracetamol',
                'price' => 100,
                'quantity' => 10,
                'status' => 'active'
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', [
            'product_name' => 'Paracetamol'
        ]);
    }

    /**
     * Test product listing
     */
    public function test_products_page_loads(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('/products');
        $response->assertStatus(200);
    }

    /**
     * Test product update
     */
    public function test_product_can_be_updated(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
            ->put('/products/' . $product->id, [
                'category' => 'Medicine',
                'subcategory' => 'Tablet',
                'product_name' => 'Updated Product',
                'price' => 200,
                'quantity' => 5,
                'status' => 'active'
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', [
            'product_name' => 'Updated Product'
        ]);
    }

    /**
     * Test product delete
     */
    public function test_product_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)
            ->delete('/products/' . $product->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}