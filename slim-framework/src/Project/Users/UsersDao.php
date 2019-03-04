<?php

namespace Project\Users;

use Project\Utils\ProjectDao;

class UsersDao
{

    private $projectDao;

    public function __construct(ProjectDao $projectDao)
    {
        $this->projectDao = $projectDao;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM USERS";
        $users = $this->projectDao->fetchAll($sql);
        return $users;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM USERS WHERE id = ?";
        $users = $this->projectDao->fetch($sql, array($id));
        return $users;
    }

    public function updateUser($userId, $user)
    {
        $sql = "UPDATE USERS SET name = ?, mail = ?, token = ? WHERE id = ?";
        $this->projectDao->execute($sql, array($user['name'], $user['mail'], $user['token'], $userId));
        $sql = "SELECT * FROM USERS WHERE id = ?";
        $updatedUser = $this->projectDao->fetch($sql, array($userId));
        return $updatedUser;
    }

    public function createUser($user)
    {
        $sql = "INSERT INTO USERS (name, mail) VALUES (?, ?)";
        $id = $this->projectDao->insert($sql, array($user['name'], $user['mail']));

        $sql = "SELECT * FROM USERS WHERE id = ?";
        $updatedUser = $this->projectDao->fetch($sql, array($id));
        return $updatedUser;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM USERS WHERE id = ?";
        return $this->projectDao->execute($sql, array($id));
    }
}