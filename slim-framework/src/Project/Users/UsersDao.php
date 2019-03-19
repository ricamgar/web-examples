<?php

namespace Project\Users;

use Project\Utils\ProjectDao;

class UsersDao
{
    private $dbConnection;

    public function __construct(ProjectDao $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM USERS";
        return $this->dbConnection->fetchAll($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM USERS WHERE id = ?";
        return $this->dbConnection->fetch($sql, array($id));
    }

    public function updateUser($userId, $user)
    {
        $sql = "UPDATE USERS SET name = ?, mail = ?, token = ? WHERE id = ?";
        $this->dbConnection->execute($sql, array($user['name'], $user['mail'], $user['token'], $userId));

        return $this->getById($userId);
    }

    public function createUser($user)
    {
        $sql = "INSERT INTO USERS (name, mail) VALUES (?, ?)";
        $id = $this->dbConnection->insert($sql, array($user['name'], $user['mail']));

        return $this->getById($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM USERS WHERE id = ?";
        $this->dbConnection->execute($sql, array($id));
    }
}