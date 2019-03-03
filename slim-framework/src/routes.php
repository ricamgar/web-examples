<?php

use Project\Users\UsersController;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/users', UsersController::class . ':getAll');
$app->get('/user/{id}', UsersController::class . ':getUserById');
$app->post('/user', UsersController::class . ':createUser');
$app->put('user/{id}', UsersController::class . 'updateUser');
$app->delete('user/{id}', UsersController::class . 'deleteUser');

// obtener un usuario por id

// crear un usuario

// actualizar un usuario

// borrar un usuario


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
