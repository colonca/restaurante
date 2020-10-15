<?php

declare(strict_types=1);

namespace src\producto\domain;


class ProductoSimple extends Producto {

      public function __construct(string $sku, string $nombre, float $costo, float $precio)
      {
          parent::__construct($sku, $nombre, $costo, $precio);
      }
}