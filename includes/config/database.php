<?php
function conectarBD():mysqli{
    $db = new mysqli('localhost','root', 'root', 'bienesraices_crud',3307);
    if(!$db){
        echo "No se pudo conectado a la BD";
        exit;
    }
    return $db;
}