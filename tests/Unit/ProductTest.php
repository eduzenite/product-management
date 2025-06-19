<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $product = Product::factory()->create([
            'title' => 'Teste Produto',
            'sale_price' => 120.00,
            'cost_price' => 100.00,
            'description' => '<p>Descrição</p>'
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Teste Produto',
        ]);
    }

    /** @test */
    /** @test */
    public function it_has_many_images()
    {
        $product = \App\Models\Product::factory()
            ->has(\App\Models\ProductImage::factory()->count(3), 'images') // <== importante!
            ->create();

        $this->assertCount(3, $product->images);
    }

}
