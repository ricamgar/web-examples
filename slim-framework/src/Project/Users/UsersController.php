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
    private $secret;

    public function __construct(ContainerInterface $container)
    {
        $this->dao = new UsersDao($container['projectDao']);
        $this->secret = $container['secret'];
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

    function updateUser(Request $request, Response $response, array $args)
    {
        if ($requestUserId = $request->getAttribute('token')->id) {
            $userId = $args['id'];
            if ($userId == $requestUserId) {
                $user = $request->getParsedBody();
                $updatedUser = $this->dao->updateUser($userId, $user);
                return $response->withJson($updatedUser);
            } else {
                return $response->withStatus(403);
            }
        } else {
            return $response->withStatus(401);
        }
    }

    function createUser(Request $request, Response $response, array $args)
    {
        $newUser = $this->dao->createUser($request->getParsedBody());

        $token = $this->getToken($newUser->id);

        $newUser->token = $token;
        $updatedUser = $this->dao->updateUser($newUser->id, (array)$newUser);

        return $response->withJson($updatedUser);
    }

    function deleteUser(Request $request, Response $response, array $args)
    {
        $this->dao->delete($args['id']);
        return $response->withStatus(204);
    }

    private function getToken($newUserId)
    {
        $now = new DateTime();
        $future = new DateTime("now +1 year");
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => base64_encode(random_bytes(16)),
            "id" => $newUserId,
        ];;
        $token = JWT::encode($payload, $this->secret, "HS256");
        return $token;
    }
}