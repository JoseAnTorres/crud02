<?php
require "../vendor/autoload.php";
use Clases\Articulo;

if(!isset($_POST['id'])){
    header("Location:index.php");
    die();
}

$articulo=new Articulo();
$articulo->setId($_POST['id']);
$articulo->delete();
$articulo=null;
header(("Location:index.php"));