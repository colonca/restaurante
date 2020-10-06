<?php

declare(strict_types=1);

namespace src\venta\domain;

class NumeroInvalidoException extends \DomainException {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

    }
}