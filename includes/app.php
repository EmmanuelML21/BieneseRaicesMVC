<?php

//funciones
require 'funciones.php';
//Conexion ala BD
require 'config/database.php';
//autoloag
require __DIR__. '/../vendor/autoload.php';
//conectar
$db = conectarBD();
use Model\ActiveRecord;

ActiveRecord::setBD($db);



