<?php

namespace  src\compra\domain;

interface  ICompraRepository {
    function save(Compra $compra) : void;
}