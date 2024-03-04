<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesCancelTest extends TestCase
{

    use RefreshDatabase;


    public function testCancelSale() : void
    {
        $mocks = $this->mocks();
        $response = $this->patch('/api/sales/'. $mocks['sale']->id);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(200);
        $this->assertEquals($responseData['data'][0]['id'],  $mocks['sale']->id);
        $this->assertEquals('Venda cancelada com sucesso', $responseData['message']);

    }


    public function testCancelInvalidSale() : void
    {
        $mocks = $this->mocks();
        $response = $this->patch('/api/sales/'.$mocks['sale']->id+1);

        $content = $response->getContent();

        $responseData = json_decode($content, true);
        $data = $responseData['data'];

        $response->assertStatus(404);
        $this->assertEquals($responseData['data'],  []);
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
