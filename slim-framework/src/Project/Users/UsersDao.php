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
}