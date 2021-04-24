<?php
require '../vendor/autoload.php';

use Clases\Articulo;
$id=$_GET['id'];
$articulo=new Articulo;
//obtener id
$articulo->setId($id);
//tenemos que tener una variable que lea el objeto del articulo, porque segui con la variable articulo y cuando lo termine
//me daba un error de uncaught error setClass::setNombre, setPvp, setStock
$articuloLeido=$articulo->read();
if(!isset($_GET['id'])){
    header("Location:index.php");
    die();
}
//Al pulsar el boton editar recoger toda la información y contemplar que no tenga errores para guardarlo correctamente
if(isset($_POST['editar'])){
$nombre=trim($_POST['nombre']);
$pvp=trim($_POST['pvp']);
$stock=trim($_POST['stock']);
if(strlen($nombre)==0 || strlen($pvp)==0 || strlen($stock)==0){
    $_SESSION['mensaje']="Rellene el campo";
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
    die();
}

//Obtener las variables de cada campo
if($articuloLeido==ucwords($nombre) || $articuloLeido==ucwords($pvp) || $articuloLeido==ucwords($stock)){
    $articulo=null;
    header(("Location:index.php"));
    die();
}
//realizar el cambio a partir del id
    $articulo->setNombre(ucwords($nombre));
    $articulo->setPvp(ucwords($pvp));
    $articulo->setStock(ucwords($stock));
    $articulo->update();
    $articulo=null;
    header(("Location:index.php"));
}else{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar articulo</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </head>

    <body style="background-color: CadetBlue;">
        <h3 class="text-center mt-3">Editar articulo</h3>
        <div class="container mt-3">
            <form name="nt" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
                <div class="mt-3">
                    <input type="text" name="nombre" value="<?php echo $articuloLeido->nombre; ?>" required class="form-control" />
                </div>
                <div class="mt-3">
                    <input type="text" name="pvp" value="<?php echo $articuloLeido->pvp; ?>" required class="form-control" />
                </div>
                <div class="mt-3">
                    <input type="text" name="stock" value="<?php echo $articuloLeido->stock; ?>" required class="form-control" />
                </div>
                <div class="mt-2">
                    <input type="submit" name="editar" value="Editar" class="btn btn-success mr-2" />
                    <a href="index.php" class="btn btn-primary mr-2">Volver</a>
                </div>
            </form>
        </div>
    </body>

    </html>
<?php
}
?>