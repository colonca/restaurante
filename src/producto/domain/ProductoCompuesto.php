<?php

declare(strict_types=1);

namespace src\producto\domain;

class ProductoCompuesto extends Producto {

     private $ingredientes = [];
     private $productos = [];

      public function __construct(string $sku, string $nombre, float $precio)
      {
          parent::__construct($sku, $nombre, 0, $precio);
      }

      public function getCosto():float
      {
          $costo = 0;

         foreach ($this->ingredientes as $value){
            $costo += $value->getCosto();
         }
         foreach ($this->productos as $value){
             $costo += $value->getCosto();
         }
         return $costo;
      }

    public function addProducto(ProductoCompuesto $producto) {
          $this->productos[] = $producto;
      }

      public function addIngrediente(ProductoSimple $productoSimple){
          $this->ingredientes[] = $productoSimple;
      }

      public function getIngredientes(){
          return $this->ingredientes;
      }

     public function getProductos(){
         return $this->productos;
     }
}