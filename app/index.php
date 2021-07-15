<?php
 error_reporting(-1);
 ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
// cors
use Psr\Http\Server\RequestHandlerInterface;

//slim para el group
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;




require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/entidades/Usuario.php';
require __DIR__ . '/entidades/Producto.php';
require __DIR__ . '/accesoDatos/accesoDatos.php';
require __DIR__ . '/controllers/usuarioController.php';
require __DIR__ . '/controllers/productoController.php';
require __DIR__ . '/funciones/funciones.php';



$app = AppFactory::create();

$app->addErrorMiddleware(true,true,true);
 
// Enable CORS
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    
    $response = $handler->handle($request);

    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'get,post');
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    return $response;
});


/*$app->get('/', function (Request $request, Response $response, array $args) {
    
    $response->getBody()->write("Bienvenido!");
    return $response;
});*/

$app->post("/", \UsuarioController::class . ':ValidarUsers' ); 

$app->group("/signin", function (RouteCollectorProxy $group) {
    $group->post('/enviar[/]', \UsuarioController::class . ':RegistrarUser' );
}); 
$app->group('/producto', function (RouteCollectorProxy $group) {
    $group->post('/agregar[/]', \productoController::class . ':CrearProducto' );
    $group->get('/mostrar[/]', \productoController::class . ':RetornarProductos' );
});

$app->run();

    
?>