<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Routing\RouteContext;
use Slim\Factory\AppFactory;

require 'src/Product.php';

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Create Twig
$twig = Twig::create('templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    $time = date("d/m/Y H:i:s");
    return $view->render($response, 'index.html', [
        'time' => $time,
    ]);
});

$app->get('/search', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    
    $requestParams = $request->getQueryParams();
    $searchParam = $requestParams['q'];

    $products = [];

    if($searchParam != NULL){
        $products = [new Product("hi", "hi", "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80")];
    }

    return $view->render($response, 'shopping.html', [
        'products' => $products
    ]);
});

$app->get('/martin', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'martin.html');
});

$app->run();

