<?php

namespace GameApi\Src\Service;

use GameApi\Src\Service\RedisClient;

class Game extends RedisClient
{
    private $key = 'leaderboard';

    public function addUserScores(string $userId, int $score)
    {
        // Add score to the leaderboard
        $this->redis->zAdd($this->key, ['INCR'], $score, $userId);
    }

    public function getUserScore(string $userId)
    {
        // Return score given member
        return $this->redis->zScore($this->key, $userId);
    }

    /**
     * @return array
     */
    public function getLeaderBoard() :array
    {
        $data = $this->redis->zRevRange($this->key, 0, -1, true);

        $leaderBoard = [];
        $user = new User();
        foreach ($data as $key => $item){
            $userData = $user->find($key);
            $leaderBoard[] = [
                'id' => $key,
                'username' => $userData['username'],
                'rank' => $item
            ];
        }

        return $leaderBoard;
    }
}
