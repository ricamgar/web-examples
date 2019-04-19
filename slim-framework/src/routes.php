<?php

use Project\Users\UsersController;

$authentication = $app->getContainer()->get('authentication');
$app->get('/users', UsersController::class . ':getAll');
$app->get('/user/{id}', UsersController::class . ':getUserById');
$app->put('/user/{id}', UsersController::class . ':updateUser')->add($authentication);
$app->post('/user', UsersController::class . ':createUser');
$app->delete('/user/{id}', UsersController::class . ':deleteUser');
