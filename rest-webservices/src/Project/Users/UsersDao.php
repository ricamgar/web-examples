<?php

namespace Project\Users;

class UsersDao
{
    public function getAll()
    {
        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $user = new User($i, "User $i", "user$i@mail.com");
            $users[$i] = $user;
        }
        return $users;
    }
}