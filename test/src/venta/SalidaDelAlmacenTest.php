<?php


namespace test\src\venta\domain;


use PHPUnit\Framework\TestCase;
use src\shared\producto\domain\ProductoCompuesto;
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
          $factura->addDetalle($producto,null,-5, 5000);
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
            $factura->addDetalle($producto,null,2, 5000);
            $resultado = $factura->facturar($inventario);
            $this->assertSame(8,$inventario[0]->getStock());
            $this->assertEquals('Las salidas de los productos se ha almacenado correctamente',$resultado);
        }

        /*
         *
            Escenario:  venta de un producto compuesto
            HU 2. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
            Criterio de Aceptación:
            1.1. La cantidad de la salida de debe ser mayor a 0
            1.2. En caso de un producto sencillo la cantidad de la salida se le disminuirá a la cantidad existente del producto.
            1.3. En caso de un producto compuesto la cantidad de la salida se le disminuirá a la cantidad existente de cada uno de su ingrediente.
            1.4. Cada salida debe registrar el costo del producto y el precio de la venta

            Dado
            Un perro sencillo (ingredientes: un pan para perros, una salchicha, una lámina de queso) precio:  5.000.
            Cuando
            va a realizar una venta de 1 perro sencillo
            Entonces
            El sistema disminuye el stock de los ingredientes  en el inventario AND  El sistema presentará el mensaje. “Las salidas de los productos se ha almacenado correctamente”
         */

          public function testVentaDeUnProductoCompuesto() : void {
              $producto1 = new ProductoSimple('PROD-0001','SALCHICHA',1000,1000,'PREPARACION');
              $producto2 = new ProductoSimple('PROD-0002','PAN PARA PERRO',1000,1000,'PREPARACION');
              $producto3 = new ProductoSimple('PROD-0003','LAMINA DE QUESO',1000,1000,'PREPARACION');
              $inventario = [new Inventario($producto1->getSku(), 10),new Inventario($producto2->getSku(), 10),new Inventario($producto3->getSku(), 10)];
              $productoCompuesto = new ProductoCompuesto('PROD-0004','PERRO SENCILLO',5000);
              $productoCompuesto->addIngrediente($producto1);
              $productoCompuesto->addIngrediente($producto2);
              $productoCompuesto->addIngrediente($producto3);
              $factura = new Factura('VENT-0001');
              $factura->addDetalle(null,$productoCompuesto,2, $productoCompuesto->getCosto());
              $resultado = $factura->facturar($inventario);
              $this->assertSame([8,8,8],[$inventario[0]->getStock(),$inventario[1]->getStock(),$inventario[2]->getStock()]);
              $this->assertEquals('Las salidas de los productos se ha almacenado correctamente',$resultado);
          }
}