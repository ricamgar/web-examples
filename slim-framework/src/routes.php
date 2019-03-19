<?php

use Project\Users\UsersController;

$app->get('/users', UsersController::class . ':getAll');
$app->get('/user/{id}', UsersController::class . ':getUserById');
$app->put('/user/{id}', UsersController::class . ':updateUser');
$app->post('/user', UsersController::class . ':createUser');
$app->delete('/user/{id}', UsersController::class . ':deleteUser');
