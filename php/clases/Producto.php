<?php
require_once"accesoDatos.php";
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
  public $nombre;
  public $porcentaje;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  public function GetId()
  {
    return $this->id;
  }
  public function GetNombre()
  {
    return $this->nombre;
  }
  public function GetPorcentaje()
  {
    return $this->porcentaje;
  }

  public function SetId($valor)
  {
    $this->id = $valor;
  }
  public function SetNombre($valor)
  {
    $this->nombre = $valor;
  }
  public function SetPorcentaje($porcentaje)
  {
    $this->porcentaje = $porcentaje;
  }
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
  public function __construct($id=NULL)
  {
    if($id != NULL){
     $obj = Producto::TraerUnProducto($id);

     $this->id = $id;
     $this->nombre = $obj->nombre;
     $this->porcentaje = $obj->porcentaje;
   }
 }

//--------------------------------------------------------------------------------//
//--TOSTRING	
 public function ToString()
 {
  return $this->id."-".$this->nombre."-".$this->porcentaje;
}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
public static function TraerUnProducto($idParametro) 
{	
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id =:id");
  $consulta = $objetoAccesoDato->RetornarConsulta("CALL TraerUnProducto(:id)");
  $consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
  $consulta->execute();
  $usuarioBuscada = $consulta->fetchObject('usuario');
  return $usuarioBuscada;	

}

public static function TraerTodasLosProductos()
{
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
  $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM misproductos");
  $consulta->execute();
  $arrProductos= $consulta->fetchAll(PDO::FETCH_CLASS, "producto");	
  return $arrProductos;
}

public static function BorrarProducto($idParametro)
{	
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from misproductos WHERE id=:id");
  $consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);		
  $consulta->execute();
  return $consulta->rowCount();

}

public static function ModificarProducto($usuario)
{
 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre=:nombre,
				apellido=:apellido,
				foto=:foto
				WHERE id=:id");
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarProducto(:id,:nombre,:clave,:tipo)");
$consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
$consulta->bindValue(':clave', md5($usuario->clave), PDO::PARAM_STR);
$consulta->bindValue(':tipo', $usuario->foto, PDO::PARAM_STR);
return $consulta->execute();
}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

public static function InsertarProducto($producto)
{
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO misproductos (`id`, `nombre`, `porcentaje`) VALUES (NULL, :nombre, :porcentaje)");
  $consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
  $consulta->bindValue(':porcentaje', $producto->porcentaje, PDO::PARAM_STR);
  $consulta->execute();		
  return $objetoAccesoDato->RetornarUltimoIdInsertado();
}	
//--------------------------------------------------------------------------------//



public static function TraerProductosTest()
{
  $arrayDeProductos=array();

  $usuario = new stdClass();
  $usuario->id = "4";
  $usuario->nombre = "rogelio";
  $usuario->clave = "agua";
  $usuario->tipo = "333333";

		//$objetJson = json_encode($usuario);
		//echo $objetJson;
  $usuario2 = new stdClass();
  $usuario2->id = "5";
  $usuario2->nombre = "Bañera";
  $usuario2->clave = "giratoria";
  $usuario2->tipo = "222222";

  $usuario3 = new stdClass();
  $usuario3->id = "6";
  $usuario3->nombre = "Julieta";
  $usuario3->clave = "Roberto";
  $usuario3->tipo = "888888";

  $arrayDeProductos[]=$usuario;
  $arrayDeProductos[]=$usuario2;
  $arrayDeProductos[]=$usuario3;

  return  $arrayDeProductos;				
}	

public static function validarProducto($nombre, $correo, $clave) {
  $ret = false;

  $existe = self::existeProducto($nombre, $correo, $clave);

  if ($existe) {
    $ret = true;
  }          

  return $ret;
}

public static function existeProducto($nombre, $correo, $clave) {
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

  $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios WHERE nombre = :nombre AND correo = :correo AND clave = :clave");
  $consulta->bindValue(':nombre', $nombre);
  $consulta->bindValue(':correo', $correo);
  $consulta->bindValue(':clave', $clave);
  $consulta->execute();

  $user = $consulta->fetchObject('usuario');
  return isset($user->id) && $user->id > 0;        
}

public static function getProductoByNombreCorreoYClave($nombre, $correo, $clave) {
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

  $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios WHERE nombre = :nombre AND correo = :correo AND clave = :clave");
  $consulta->bindValue(':nombre', $nombre);
  $consulta->bindValue(':correo', $correo);
  $consulta->bindValue(':clave', $clave);
  $consulta->execute();

  $user = $consulta->fetchObject('usuario');
  return $user;        
}
}
