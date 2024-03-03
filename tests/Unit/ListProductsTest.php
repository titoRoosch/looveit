<?php

namespace Tests\Unit;

use App\Models\Products;
use App\Operations\Products\ProductsSearcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }
    /**
     * Lista todos os produtos
     */
    public function testListAllProductsSuccess(): void
    {
        #preparation
        $mocks = $this->mocks();

        #run
        $operation = new ProductsSearcher();
        $products = $operation->search();

        #assertions
        $this->assertEquals(6, $products->count());
    }

    /**
     * Lista um produto específico
     */
    public function testListSpecificProductSuccess(): void
    {
        #preparation
        $mocks = $this->mocks();

        #run
        $operation = new ProductsSearcher();
        $products = $operation->search($mocks[0]->id);

        #assertions
        $this->assertEquals($mocks[0]->id, $products->id);
    }


    /**
     * Tenta listar um produto de código inválido
     */
    public function testListInvalidProductFail(): void
    {
        $operation = new ProductsSearcher();
        $products = $operation->search(1);

        #assertions
        $this->assertNull($products);
    }

    protected function mocks() 
    {
        $prod = Products::factory(6)->create();
        return $prod;
    }
    
    public function tearDown(): void
    {
        parent::tearDown();
    }
}
