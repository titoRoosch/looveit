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
        $mocks = $this->mocks();

        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][0]->id,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales', $data);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals('Venda criada com sucesso', $responseData['message']);
        $this->assertEquals($mocks['products'][0]->id, $data[0]['products'][0]['product_id']);
    }


    public function testCreateSaleNoProducts() : void
    {
        $data = [
            'products' => []
        ];

        $response = $this->post('/api/sales', $data);

        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(422);
        $this->assertEquals('O campo products é obrigatório.', $responseData['message']);
    }

    public function testCreateInvalidProduct() : void
    {
        $mocks = $this->mocks();

        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][2]->id+1,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales', $data);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(400);
        $this->assertEquals('É necessário informar pelo menos 1 produto válido', $responseData['message']);

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

        $response = $this->post('/api/sales/'.$mocks['sale']->id, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals('Venda atualizada com sucesso', $responseData['message']);
        $this->assertEquals($mocks['products'][0]->id, $data[0]['products'][0]['product_id']);

    }

    public function testAddEmptyProduct() : void
    {
        $mocks = $this->mocks();
        $data = [
            'products' => []
        ];

        $response = $this->post('/api/sales/'.$mocks['sale']->id, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(422);
        $this->assertEquals('O campo products é obrigatório.', $responseData['message']);
    }

    public function testAddInvalidProduct() : void
    {
        $mocks = $this->mocks();
        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][2]->id+1,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales/'.$mocks['sale']->id, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(400);
        $this->assertEquals('É necessário informar pelo menos 1 produto válido', $responseData['message']);
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

        $response = $this->post('/api/sales/'.$mocks['sale']->id+1, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(404);
        $this->assertEquals('Venda não encontrada ou cancelada', $responseData['message']);
    }

    public function testAddProductToCanceledSale() : void
    {
        $mocks = $this->mocks();
        $mocks['sale']->status = 'canceled';
        $mocks['sale']->update();

        $data = [
            'products' => [
                [
                    'product_id' => $mocks['products'][0]->id,
                    'quantity' => 1
                ],
            ]
        ];

        $response = $this->post('/api/sales/'.$mocks['sale']->id, $data);
        $content = $response->getContent();

        $responseData = json_decode($content, true);

        $response->assertStatus(404);
        $this->assertEquals('Venda não encontrada ou cancelada', $responseData['message']);
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
