<?php


namespace test\src\venta\domain;


use PHPUnit\Framework\TestCase;
use src\venta\domain\Factura;
use src\venta\domain\NumeroInvalidoException;
use src\shared\inventario\Inventario;
use src\shared\producto\domain\ProductoSimple;

class SalidaDelAlmacenTest extends TestCase
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
          $inventario = [new Inventario($producto->getSku(), 10)];
          $factura = new Factura('VENT-0001');
          $factura->addDetalle($producto,-5, 5000);
      }

      /*
       *
            Escenario:  cantidad de salida correcta.
            HU 2. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
            Criterio de Aceptación:
            1.1. La cantidad de la salida de debe ser mayor a 0
            1.2. En caso de un producto sencillo la cantidad de la salida se le disminuirá a la cantidad existente del producto.
            Dado
            El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple con inventario de ese producto en 10 unidades.
            Cuando
            va a realizar una venta de 2 unidades
            Entonces
            El sistema disminuye el stock del  producto en el inventario AND  El sistema presentará el mensaje. “Las salidas de los productos se ha almacenado correctamente”
       */
        public function testcantidadDeSalidaCorrecta() : void{
            $producto = new ProductoSimple('PROD-0001','GASEOSA LITRO',3000,5000,'VENTA-DIRECTA');
            $inventario = [new Inventario($producto->getSku(), 10)];
            $factura = new Factura('VENT-0001');
            $factura->addDetalle($producto,2, 5000);
            $resultado = $factura->facturar($inventario);
            $this->assertSame(8,$inventario[0]->getStock());
            $this->assertEquals('Las salidas de los productos se ha almacenado correctamente',$resultado);
        }
}