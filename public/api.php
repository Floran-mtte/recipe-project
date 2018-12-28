<?php
use App\api\Controllers\RecipeController;
use App\api\Models\Recipe;

require_once __DIR__ . '/../vendor/autoload.php';

$http_codes = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    102 => 'Processing',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => 'Switch Proxy',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    418 => 'I\'m a teapot',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    425 => 'Unordered Collection',
    426 => 'Upgrade Required',
    449 => 'Retry With',
    450 => 'Blocked by Windows Parental Controls',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    509 => 'Bandwidth Limit Exceeded',
    510 => 'Not Extended'
);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/recipe/{id:\d+}', 'RecipeController/getRecipe');
    $r->addRoute('GET', '/recipe', 'RecipeController/get');
    $r->addRoute('GET', '/recipe/{val}', 'RecipeController/autoComplete');
    $r->addRoute('PUT', '/recipe/{id:\d+}', 'RecipeController/update');
    $r->addRoute('POST', '/recipe', 'RecipeController/insert');
    $r->addRoute('DELETE', '/recipe/{id:\d+}', 'RecipeController/delete');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode('api.php',$_SERVER["REQUEST_URI"]);
$uri =  end($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        list($class, $method) = explode("/", $handler, 2);

        switch ($class)
        {
            case 'RecipeController':
                switch($method)
                {
                    case 'get':

                        $recipeController = new RecipeController(new Recipe());
                        $response = $recipeController->get();
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                    case 'getRecipe':

                        $recipeController = new RecipeController(new Recipe());
                        $response = $recipeController->getRecipe($vars['id']);
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                    case 'update':

                        $headers = getallheaders();
                        $recipeName = $headers['data-recipe-name'];
                        $recipeTime = $headers['data-recipe-time'];
                        $recipeIngredients = $headers['data-recipe-ingredient'];
                        $recipeController = new RecipeController(new Recipe(null, $recipeName, $recipeTime, $recipeIngredients));
                        $response = $recipeController->update($vars['id']);
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                    case 'delete':

                        $recipeController = new RecipeController(new Recipe());
                        $response = $recipeController->delete($vars['id']);
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                    case 'insert':

                        $headers = getallheaders();
                        $recipeName = $headers['data-recipe-name'];
                        $recipeTime = $headers['data-recipe-time'];

                        $recipeController = new RecipeController(new Recipe(null,$recipeName,$recipeTime));
                        $response = $recipeController->insert();
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                    case 'autoComplete':

                        $recipeController = new RecipeController(new Recipe());
                        $response = $recipeController->autoComplete($vars['val']);
                        header($_SERVER["SERVER_PROTOCOL"]." ".$response['code']. " " . $http_codes[$response['code']]);
                        echo json_encode($response);

                        break;
                }
            break;

        }
    break;
}


