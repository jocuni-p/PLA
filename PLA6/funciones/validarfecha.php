<?php

function validarFecha(string $fecha): bool {
    $formato = 'd/m/Y';
    $objetoFecha = DateTime::createFromFormat($formato, $fecha);
    return $objetoFecha && $objetoFecha->format($formato) === $fecha;
}
?>
