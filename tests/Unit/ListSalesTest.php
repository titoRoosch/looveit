<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListSalesTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Lista todos as vendas
     */
    public function testListAllSalesSuccess(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Lista uma venda específica
     */
    public function testListSpecificSaleSuccess(): void
    {
        $this->assertTrue(true);
    }


    /**
     * Tenta listar uma venda de código inválido
     */
    public function testListInvalidSaleFail(): void
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
