<?php

namespace Tests\Feature;

use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetProducts(): void
    {
        $this->mocks();
        $response = $this->get('/api/products');

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals(3, count($data));
    }

    /**
     * A basic feature test example.
     */
    public function testGetProductsById(): void
    {
        $mocks = $this->mocks();
        $response = $this->get('/api/products/'.$mocks[0]->id);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals(1, count($data));
    }

    /**
     * A basic feature test example.
     */
    public function testGetProductsByNonExistingId(): void
    {
        $response = $this->get('/api/products/1');

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(404);
        $this->assertEquals(0, count($data));
        $this->assertEquals('Produto não encontrado', $responseData['message']);
    }

    protected function mocks() 
    {
        $prod = Products::factory(3)->create();
        return $prod;
    }
    
}
