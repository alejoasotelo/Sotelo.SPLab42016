<?php
require_once __DIR__.'/clases/Usuario.php';
require_once __DIR__.'/clases/Producto.php';

$request_body = file_get_contents('php://input');
$request = json_decode($request_body);

switch ($request->datos->task) {
	case 'listar':
		
		$productos = Producto::TraerTodasLosProductos();

		echo json_encode(array('productos' => $productos));

		break;
	case 'listarUsuarios':
		
		$usuarios = Usuario::TraerTodasLosUsuarios();

		echo json_encode(array('usuarios' => $usuarios));

		break;

	case 'agregar':
		
		$r = Producto::InsertarProducto($request->datos->producto);

		echo json_encode(array('success' => $r > 0));

		break;

	case 'agregarUsuario':
		
		$r = Usuario::InsertarUsuario($request->datos->usuario);

		echo json_encode(array('success' => $r > 0));

		break;

	case 'borrar':
		
		$r = Producto::BorrarProducto($request->datos->id);

		echo json_encode(array('success' => $r > 0));

		break;

	case 'borrarUsuario':
		
		$r = Usuario::BorrarUsuario($request->datos->id);

		echo json_encode(array('success' => $r > 0));

		break;

	case 'guardarUsuario':
		
		$r = Usuario::ModificarUsuario($request->datos->usuario);

		echo json_encode(array('success' => $r > 0));

		break;

	case 'traerUsuario':
		
		$usuario = Usuario::TraerUnUsuario($request->datos->id);

		echo json_encode(array('usuario' => $usuario));

		break;


	
	default:
		# code...
		break;
}