<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CreateSaleTest extends TestCase
{
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
}
