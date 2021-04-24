<?php

namespace Clases;

use Clases\Conexion;
use PDO, PDOException;

//Articulo procedente de conexion
class Articulo extends Conexion
{
    private $id;
    private $nombre;
    private $pvp;
    private $stock;

    //Para crear los objetos al llamar la clase
    public function __construct()
    {
        parent::__construct();
    }

    //Tabla de articulos
    public function mostrarTabla()
    {
        //consulta para mostrar todos los articulos de la tabla con todos sus atributos
        $consulta = "select * from articulos";
        //preparar consulta con el codigo
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta
            $stmt->execute();
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error no carga tabla: " . $ex->getMessage());
        }
        return $stmt;
    }

    //Para crear articulos desde crearArticulo
    public function create()
    {
        //consulta de insercion de articulos en la tabla
        $consulta = "insert into articulos(nombre, pvp, stock) values(:n, :p, :s)";
        //preparar consulta con el codigo
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros :atributo
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->pvp,
                ':s' => $this->stock
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al insertar articulo: " . $ex->getMessage());
        }
    }

    //Para borrar articulos desde borrarArticulo
    public function delete()
    {
        //consulta para borrar desde tabla en aquel articulo que posea el id correspondiente
        $consulta = "delete from articulos where id=:i";
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros :atributo
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al borrar articulo: " . $ex->getMessage());
        }
    }

    //Para recuperar aquel articulo con el id que coincida con el parametro
    public function read()
    {
        //consulta para recuperar aquel articulo con el id leido
        $consulta = "select * from articulos where id=:i";
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros :atributo
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al leer articulo: " . $ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //consulta para actualizar los articulos con los parametros nombre, stock, pvp e id
    public function update(){
        //realizar la actualizacion de las variables a partir del id deseado
        $consulta="update articulos set nombre=:n, pvp=:p, stock=:s where id=:i";
        $stmt=parent::$conexion->prepare($consulta);
        try{
            //ejecucion de la consulta con estos parametros
            $stmt->execute([
                ':i'=>$this->id,
                ':n'=>$this->nombre,
                ':p'=>$this->pvp,
                ':s'=>$this->stock
                ]);
        }catch(PDOException $ex){
            //error si falla el intento
            die("Error al actualizar articulo: ".$ex->getMessage());
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of pvp
     */
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * Set the value of pvp
     *
     * @return  self
     */
    public function setPvp($pvp)
    {
        $this->pvp = $pvp;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}
