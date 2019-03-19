<?php

namespace Project\Users;

use DateTime;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController
{
    private $dao;

    public function __construct(ContainerInterface $container)
    {
        $dbConnection = $container['dbConnection'];
        $this->dao = new UsersDao($dbConnection);
    }

    function getAll(Request $request, Response $response, array $args)
    {
        $users = $this->dao->getAll();
        return $response->withJson($users);
    }

    function getUserById(Request $request, Response $response, array $args)
    {
        $user = $this->dao->getById($args['id']);
        return $response->withJson($user);
    }

    function updateUser(Request $request, Response $response, array $args) {
        $userId = $args['id'];
        $body = $request->getParsedBody();
        $user = $this->dao->updateUser($userId, $body);
        return $response->withJson($user);
    }

    function createUser(Request $request, Response $response, array $args) {
        $body = $request->getParsedBody();
        $user = $this->dao->createUser($body);
        return $response->withJson($user);
    }

    function deleteUser(Request $request, Response $response, array $args) {
        $userId = $args['id'];
        $this->dao->delete($userId);
        return $response->withStatus(201);
    }
}