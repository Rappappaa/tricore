<?php

namespace App\Controller;

class RedisService
{
    private $redisClient;
    private $redisProtocol;
    private $redisHost;
    private $redisPort;
    private $redisDB;
    private $redisExpiration;

    public function __construct()
    {
        $this->redisProtocol = $_ENV['REDIS_PROTOCOL'];
        $this->redisHost = $_ENV['REDIS_HOST'];
        $this->redisPort = $_ENV['REDIS_PORT'];
        $this->redisDB = $_ENV['REDIS_DB'];
        $this->redisExpiration = $_ENV['REDIS_EXPIRATION'];

        $connectionString = $this->redisProtocol . "://" . $this->redisHost . ":" . $this->redisPort;

        $this->redisClient = new \Predis\Client($connectionString);
    }

    public function get(string $key)
    {
        return $this->redisClient->get($key);
    }

    public function set(string $key, mixed $data, ?int $expire = null)
    {
        $expiration = $expire == null ? $this->redisExpiration : $expire;
        
        $this->redisClient->set($key, $data);

        $this->redisClient->expire($key, $expiration);
        
        return;
    }

    public function remove(string $key)
    {
        return $this->redisClient->del($key);
    }

    public function flushAll()
    {
        return $this->redisClient->flushall();
    }
}