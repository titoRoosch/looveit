<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetSales(): void
    {
        $this->mocks();
        $response = $this->get('/api/sales');

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals(1, count($data));
    }

    /**
     * A basic feature test example.
     */
    public function testGetSalesById(): void
    {
        $mocks = $this->mocks();
        $response = $this->get('/api/sales/' . $mocks['sale']->id);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals(1, count($data));
    }

    /**
     * A basic feature test example.
     */
    public function testGetSalesByInvalidId(): void
    {
        $this->mocks();
        $response = $this->get('/api/sales/267895');

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals(0, count($data));
    }


    protected function mocks() 
    {
        $prod = Products::factory(3)->create();
        $sale = Sales::factory()->create();

        return [
            'products' => $prod,
            'sale' => $sale
        ];
    }
    
}
