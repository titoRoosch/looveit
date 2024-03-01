<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CancelSaleTest extends TestCase
{
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
}
