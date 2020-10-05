<?php

declare(strict_types=1);

namespace src\shared\producto\domain;

use src\shared\producto\domain\Producto;
use src\shared\producto\domain\TipoProducto;

class ProductoSimple extends Producto {

      private $tipoProducto;

      public function __construct(string $sku, string $nombre, float $costo, float $precio,string $tipo)
      {
          parent::__construct($sku, $nombre, $costo, $precio);
          $this->tipoProducto =  new TipoProducto($tipo);
      }

}