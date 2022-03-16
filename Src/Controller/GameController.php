<?php

namespace GameApi\Src\Controller;

use GameApi\Src\Service\Game;
use GameApi\Src\Service\User;
use GameApi\Src\Http\JsonResponse;
use GameApi\Src\Http\Request;

class GameController
{
    public function endgame(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['Players'])){
            $responseData = ['status' => 'error', 'message' => 'username and password are required.'];
            $response = new JsonResponse();
            return $response->getResponse($responseData);
        }

        $userData = [];
        $user = new User();
        $game = new Game();
        foreach ($data['Players'] as $player){
            if(isset($player['id'], $player['score']) && count($user->find($player['id']))){
                $game->addUserScores($player['id'], $player['score']);
                $userData[] = ['id' => $player['id'], 'score' => $game->getUserScore($player['id'])];
            }
        }

        $responseData = [
            'status' => 'success',
            'result' => $userData
        ];
        $response = new JsonResponse();
        return $response->getResponse($responseData);
    }

    public function leaderboard(Request $request)
    {
        $game = new Game();

        $responseData = [
            'status' => 'success',
            'result' => $game->getLeaderBoard()
        ];

        $response = new JsonResponse();
        return $response->getResponse($responseData);
    }
}
