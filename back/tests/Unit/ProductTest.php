<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function test_index(): void
    {
        $this->getJson('/api/products')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(Product::all()->toArray());
    }

    public function test_store(): void
    {
        $newProduct = Product::factory()->make()->toArray();

        $this->postJson('/api/products', $newProduct)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($newProduct);
    }

    public function test_show(): void
    {
        $product = Product::inRandomOrder()->first();

        $this->getJson("/api/products/$product->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($product->toArray());
    }

    public function test_update(): void
    {
        $product = Product::factory()->create();

        $newProductValues = Product::factory()->make()->toArray();

        $this->putJson("/api/products/$product->id", $newProductValues)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($newProductValues);
    }

    public function test_destroy(): void
    {
        $product = Product::factory()->create();

        $this->deleteJson("/api/products/$product->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($product->toArray());

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
