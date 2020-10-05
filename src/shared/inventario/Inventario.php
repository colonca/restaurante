<?php

namespace src\shared\inventario;

use src\shared\producto\domain\ProductoSimple;

class Inventario
{
     private $sku;
     private $stock;

     public function __construct(string $sku, int $stock)
     {
            $this->sku = $sku;
            $this->stock = $stock;
     }

     public function getSku() : string{
         return $this->sku;
     }


     public function entrada(int $cantida) : void {
         $this->stock +=$cantida;
     }

     public function salida(int $cantidad) : void  {
         $this->stock -= $cantidad;
     }
}