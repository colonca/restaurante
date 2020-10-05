<?php

namespace test\src\compra;


use PHPUnit\Framework\TestCase;
use src\compra\domain\Compra;
use src\compra\domain\NumeroInvalidoException;
use src\shared\inventario\Inventario;
use src\shared\producto\domain\ProductoSimple;

class EntradaAlAlmacenTest extends TestCase
{

    /*
     *
        Escenario:  entrada del producto incorrecta
        HU 1. COMO USUARIO QUIERO REGISTRAR LA ENTRADA DE PRODUCTOS.
        Criterio de Aceptación:
        1.1 .La cantidad de la entrada debe ser mayor a 0.
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple con inventario de ese producto en cero y una entrada de -10 unidades
        Cuando
        El administrador va a dar a entrada a un nuevo producto
        Entonces
        El sistema presentará la excepción NumeroInvalidaException.
     */
    public function testEntradaDelProductoIncorrecta() : void {
        $this->expectException(NumeroInvalidoException::class);
        $producto =  new ProductoSimple('PROD-0001','Gaseosa Litro',3000,5000,'PREPARACION');
        $inventario = [new Inventario($producto->getSku(), 0)];
        $compra = new Compra('COMP-0001');
        $compra->addDetalle('PROD-0001',-1,5000);
        $this->assertSame(-1,$inventario[0]->getStock());
        $this->assertEquals('Las entradas de los productos se ha almacenando correctamente',$resultado);
    }

    /* * Escenario:  entrada del producto correcto.
        HU 1. COMO USUARIO QUIERO REGISTRAR LA ENTRADA PRODUCTOS
        Criterio de Aceptación:
        1.1. La cantidad de la entrada debe ser mayor a 0.
        1.2. La cantidad de la entrada se le aumentará a la cantidad existente del producto.
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple y van a entrar 5 unidades
        al almacén por un volor de $3000
        Cuando
        El administrador va a dar entrada al almacén a un nuevo producto
        Entonces El sistema aumentará el stock del  producto en el inventario AND
        El sistema presentará el mensaje. “Las entradas de los productos se ha almacenando correctamente”
     */
    public function testEntradaDelProductoCorrecto() : void {
        $producto =  new ProductoSimple('PROD-0001','Gaseosa Litro',3000,5000,'PREPARACION');
        $inventario = [new Inventario($producto->getSku(), 0)];
        $compra = new Compra('COMP-0001');
        $compra->addDetalle('PROD-0001',5,5000);
        $resultado = $compra->darDeAlta($inventario);
        $this->assertSame(5,$inventario[0]->getStock());
        $this->assertEquals('Las entradas de los productos se ha almacenando correctamente',$resultado);
    }

}