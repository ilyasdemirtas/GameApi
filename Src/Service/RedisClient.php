<?php

namespace GameApi\Src\Service;

abstract class RedisClient
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('redis', '6379', 2.5);
    }
}
