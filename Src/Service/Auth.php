<?php

namespace GameApi\Src\Service;

use GameApi\Src\Service\RedisClient;

class Auth extends RedisClient
{
    private $key = 'user';

    /**
     * @param string $username
     * @param string $password
     * @return int
     */
    public function signup(string $username, string $password): int
    {
        // Generate Increment Id
        $id = $this->redis->incr($this->key . ':') ?? 1;

        // Create new user
        $this->redis->hSet($this->key . ':' . $id, 'username', $username);
        $this->redis->hSet($this->key . ':' . $id, 'password', md5($password));

        // Generate path mapping for search
        $this->redis->sAdd('username:' . $username, $id);
        $this->redis->sAdd('password:' . md5($password), $id);

        return $id;
    }

    /**
     * @param string $username
     * @param string $password
     * @return string|null
     */
    public function signin(string $username, string $password) :?string
    {
        $user = $this->redis->sInter('username:' . $username,  'password:' . md5($password));

        if(!count($user)){
            return null;
        }

        return $user[0];
    }
}
