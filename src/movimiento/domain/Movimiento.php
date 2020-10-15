<?php

declare(strict_types=1);

namespace src\movimiento\domain;

use src\producto\domain\ProductoSimple;

class Movimiento
{

    public function __construct()
   {
       $this->detalle_movimiento = [];
   }

   public function entrada(ProductoSimple $producto, int $cantidad,float $costo) : void {
       $detalle = new Detalle_Movimiento($producto->getSku(),$cantidad,$costo,0,'ENTRADA');
       $this->detalle_movimiento[] = $detalle;
   }

   public function salida(ProductoSimple $producto, int $cantidad, float $costo,float $precio) : void {
        $detalle = new Detalle_Movimiento($producto->getSku(),$cantidad,$costo,$precio,'SALIDA');
        $this->detalle_movimiento[] = $detalle;
   }

   public function getCantidad(string $sku) : int {
      $entradas = 0;
      foreach($this->detalle_movimiento as $value){
          if($value->equals($sku)){
              $entradas += $value->getTipo() == 'ENTRADA' ? $value->getCantidad() : 0;
          }
      }
      return $entradas;
   }
}