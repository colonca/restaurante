<?php

declare(strict_types=1);

namespace src\shared\producto\domain;

use src\shared\producto\domain\Producto;

class ProductoCompuesto extends Producto {

     private $ingredientes = [];
     private $productos = [];

      public function __construct(string $sku, string $nombre, float $precio)
      {
          parent::__construct($sku, $nombre, 0, $precio);
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