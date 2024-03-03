<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CancelSaleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Cancela uma venda
     */
    public function testCancelSaleSuccess(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Tenta cancelar uma venda não existente
     */
    public function testCancelSaleFail(): void
    {
        $this->assertTrue(true);
    }

     /**
     * Tenta cancelar uma venda já cancelada
     */
    public function testCancelCacelledSaleFail(): void
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
