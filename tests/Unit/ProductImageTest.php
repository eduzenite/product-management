<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $image->product);
        $this->assertEquals($product->id, $image->product->id);
    }
}
