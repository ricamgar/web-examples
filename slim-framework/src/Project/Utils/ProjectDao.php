<?php

namespace Project\Utils;


interface ProjectDao
{
    public function fetchAll($sql, $params = null);
}