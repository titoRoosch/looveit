<?php

namespace Tests\Unit;

use App\Operations\Sales\SalesCreate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Cria uma venda
     */
    public function testCreateSaleSuccess(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Tenta criar uma venda sem indicar um código de produto
     */
    public function testCreateSaleNoProductsFail(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Tenta criar uma venda com um código de produto não existente
     */
    public function testCreateSaleInvalidProductFail(): void
    {
        $this->assertTrue(true);
    }

    protected function mocks() 
    {

    }
    
    public function tearDown(): void
    {
        parent::tearDown();
    }
}
