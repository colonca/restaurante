<?php


namespace test\src\venta\domain;


use PHPUnit\Framework\TestCase;
use src\venta\domain\NumeroInvalidoException;
use src\shared\inventario\Inventario;
use src\shared\producto\domain\ProductoSimple;

class SalidaDelAlmacen extends TestCase
{

    /*
     *
        Escenario:  cantidad de salida incorrecta.
        HU 2. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
        Criterio de Aceptación:
        1.1 1. La cantidad de la salida de debe ser mayor a 0
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple con inventario de ese producto en 10 unidades.
        Cuando
        va a realizar una venta de -5 unidades
        Entonces
        El sistema presentará la excepción NumeroInvalidaException.
     */
      public function testcantidadDeSalidaIncorrecta() : void{
          $this->expectException(NumeroInvalidoException::class);
          $producto = new ProductoSimple('PROD-0001','GASEOSA LITRO',3000,5000,'VENTA-DIRECTA');
          $inventario = [new Inventario($producto->getSku(), 0)];
          $factura = new Factura('VENT-0001');
          $factura->addDetalle('PROD-0001',-5, 5000);
      }

}