<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesCreateTest extends TestCase
{

    use RefreshDatabase;


    public function testCreateSale() : void
    {
        $data = [
            'products' => [
                [
                    'product_id' => 1,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales', $data);


    }


    public function testCreateSaleNoProducts() : void
    {
        $data = [
            'products' => []
        ];

        $response = $this->post('/api/sales', $data);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(400);
        $this->assertEquals('É necessário informar pelo menos 1 produto válido', $responseData['message']);
    }

    public function testCreateInvalidProduct() : void
    {
        $mocks = $this->mocks();

    }

    public function testAddProduct() : void
    {
        $mocks = $this->mocks();
        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][0]->id,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales/'.$mocks['sales'][0]->id, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(200);
        $this->assertEquals('Venda não encontrada', $responseData['message']);

    }

    public function testAddEmptyProduct() : void
    {
        $mocks = $this->mocks();
    }

    public function testAddInvalidProduct() : void
    {
        $mocks = $this->mocks();
    }

    public function testAddProductToInvalidSale() : void
    {
        $mocks = $this->mocks();
        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][0]->id,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales/12568', $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(404);
        $this->assertEquals('Venda não encontrada', $responseData['message']);
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
