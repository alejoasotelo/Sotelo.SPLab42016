<?php
include_once './vendor/autoload.php';
include_once './clases/Usuario.php';

use \Firebase\JWT\JWT;

$request_body = file_get_contents('php://input');
$request = json_decode($request_body);

$ret = array();

if(Usuario::validarUsuario($request->nombre, $request->correo, $request->clave))
{
	$user = Usuario::getUsuarioByNombreCorreoYClave($request->nombre, $request->correo, $request->clave);

	$key = "1234";
	$token["iat"] = time() ;
	$token["exp"] = time() + 3600;

	$token["nombre"] = $user->nombre;
	$token["correo"] = $user->correo;
	$token["tipo"] = $user->tipo;
	$token["foto"] = $user->foto;

	$ret["segundoparcial"] =  JWT::encode($token, $key);
} else {
	$ret["segundoparcial"] = false;
}

echo json_encode($ret);
?>
