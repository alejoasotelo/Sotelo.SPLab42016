<?php
require_once"accesoDatos.php";
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
  public $correo;
  public $nombre;
  public $clave;
  public $tipo;
  public $foto;

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
  public function GetFoto()
  {
    return $this->foto;
  }
  public function GetClave()
  {
    return $this->clave;
  }
  public function GetCorreo()
  {
    return $this->correo;
  }
  public function GetTipo()
  {
    return $this->tipo;
  }

  public function SetId($valor)
  {
    $this->id = $valor;
  }
  public function SetNombre($valor)
  {
    $this->nombre = $valor;
  }
  public function SetFoto($valor)
  {
    $this->foto = $valor;
  }
  public function SetClave($valor)
  {
    $this->clave = $valor;
  }
  public function SetCorreo($valor)
  {
    $this->correo = $valor;
  }
  public function SetTipo($valor)
  {
    $this->tipo = $valor;
  }
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
  public function __construct($id=NULL)
  {
    if($id != NULL){
     $obj = Usuario::TraerUnUsuario($id);

     $this->id = $id;
     $this->nombre = $obj->nombre;
     $this->foto = $obj->foto;
     $this->clave = $obj->clave;
     $this->tipo = $obj->tipo;
     $this->correo = $obj->correo;
     $this->github = $obj->github;
   }
 }

//--------------------------------------------------------------------------------//
//--TOSTRING	
 public function ToString()
 {
  return $this->id."-".$this->nombre."-".$this->tipo;
}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
public static function TraerUnUsuario($idParametro) 
{	


  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios WHERE id =:id");
  $consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
  $consulta->execute();
  $usuarioBuscada = $consulta->fetchObject('usuario');
  return $usuarioBuscada;	

}

public static function TraerTodasLosUsuarios()
{
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios");
  $consulta->execute();			
  $arrUsuarios= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
  return $arrUsuarios;
}

public static function BorrarUsuario($idParametro)
{	
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM misusuarios WHERE id=:id");	
  $consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
  $consulta->execute();
  return $consulta->rowCount();

}

public static function ModificarUsuario($usuario)
{
 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
 $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE misusuarios SET nombre = :nombre, correo=:correo, tipo=:tipo, clave =:clave, foto=:foto
  WHERE id=:id");
 $consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
 $consulta->bindValue(':correo', $usuario->correo, PDO::PARAM_STR);
 $consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
 $consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
 $consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
 $consulta->bindValue(':foto', isset($usuario->foto) ? $usuario->foto : 'sin foto', PDO::PARAM_STR);
 return $consulta->execute();
}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

public static function InsertarUsuario($usuario)
{
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
  $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO misusuarios (`id`, `correo`, `nombre`, `clave`, `tipo`, `foto`) VALUES (NULL, :correo, :nombre, :clave, :tipo, :foto)");
  $consulta->bindValue(':correo',$usuario->correo, PDO::PARAM_STR);
  $consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
  $consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
  $consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
  $consulta->bindValue(':foto', isset($usuario->foto) ? $usuario->foto : 'sin foto', PDO::PARAM_STR);
  $consulta->execute();		
  return $objetoAccesoDato->RetornarUltimoIdInsertado();


}	
//--------------------------------------------------------------------------------//



public static function TraerUsuariosTest()
{
  $arrayDeUsuarios=array();

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

  $arrayDeUsuarios[]=$usuario;
  $arrayDeUsuarios[]=$usuario2;
  $arrayDeUsuarios[]=$usuario3;

  return  $arrayDeUsuarios;				
}	

public static function validarUsuario($nombre, $correo, $clave) {
  $ret = false;

  $existe = self::existeUsuario($nombre, $correo, $clave);

  if ($existe) {
    $ret = true;
  }          

  return $ret;
}

public static function existeUsuario($nombre, $correo, $clave) {
  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

  $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios WHERE nombre = :nombre AND correo = :correo AND clave = :clave");
  $consulta->bindValue(':nombre', $nombre);
  $consulta->bindValue(':correo', $correo);
  $consulta->bindValue(':clave', $clave);
  $consulta->execute();

  $user = $consulta->fetchObject('usuario');
  return isset($user->id) && $user->id > 0;        
}

public static function getUsuarioByNombreCorreoYClave($nombre, $correo, $clave) {
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
