<?php

use Project\Users\UsersController;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/users', UsersController::class . ':getAll');
$app->get('/user/{id}', UsersController::class . ':getUserById');
$app->post('/user', UsersController::class . ':createUser');


$authentication = $app->getContainer()->get("authentication");
$app->put('/user/{id}', UsersController::class . ':updateUser')->add($authentication);
$app->delete('/user/{id}', UsersController::class . ':deleteUser')->add($authentication);
