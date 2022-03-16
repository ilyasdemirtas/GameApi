<?php

use GameApi\Src\Http\JsonResponse;
use GameApi\Src\Http\Request;
use GameApi\Src\Http\Router;
use GameApi\Src\Exception\NotFoundException;

include_once 'autoloader.php';
include_once 'Src/routes.php';

try {
    $router = new Router(new Request(), $routes);
    $router->init();
} catch (Exception | Error $exception){

    if ($exception instanceof NotFoundException){
        $statusCode = 404;
    } else {
        $statusCode = 500;
    }

    $responseData = [
        'status' => 'error',
        'message' => $exception->getMessage()
    ];
    $response = new JsonResponse();

    echo $response->getResponse($responseData, $statusCode);
}
