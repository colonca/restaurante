<?php

namespace test\src\inventario\compras;

use Monolog\Test\TestCase;

class EntradaAlAlmacenTest extends TestCase
{
    /* * Escenario:  entrada del producto correcto.
        HU 1. Como administrador quiero registrar productos
        Criterio de Aceptación:
        1.1. La cantidad de la entrada debe ser mayor a 0.
        1.2. La cantidad de la entrada se le aumentará a la cantidad existente del producto.
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple y van a entrar 5 unidades
        al almacén por un volor de $3000
        Cuando
        El administrador va a dar entrada al almacén a un nuevo producto
        Entonces El sistema aumentará el stock del  producto en el inventario AND
        El sistema presentará el mensaje. “El Producto “Gaseosa litro” ha sido registrado correctamente la cantidad en stock es de 5 unidades”
     */
       public function testEntradaDelProductoCorrecto() : void {
           $producto =  new ProductoSimple('PROD-0001','Gaseosa Litro',new Tipo_producto('PREPARACION'));
           $compra = new Compra('COMP-0001',new Inventario($producto,0));
           $resultado =  $compra->addDetalle($producto,5,5000);
           $this->assertEquals('El Producto Gaseosa litro ha sido registrado correctamente la cantidad en stock es de 5 unidades',$resultado);
       }
}