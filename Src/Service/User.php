<?php

namespace GameApi\Src\Service;

use GameApi\Src\Service\RedisClient;

class User extends RedisClient
{
    private $key = 'user';

    public function find(int $id)
    {
        return $this->redis->hGetAll($this->key . ':' . $id);
    }
}
