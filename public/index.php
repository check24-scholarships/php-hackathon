<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Routing\RouteContext;
use Slim\Factory\AppFactory;

include 'src/databaseFunctions.php';

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
    $products = [];

    $db = new DBFuncs('db.sqlite3');
    $sort = 'DESC';

    if(array_key_exists('sort', $requestParams) && strtolower($requestParams['sort']) == "asc"){
        $sort = 'ASC';
    }

    if(array_key_exists('q', $requestParams)){
        $products = $db->searchProductByName($requestParams['q'], $sort);
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

