<?php

namespace GameApi\Src\Controller;

use GameApi\Src\Service\Auth;
use GameApi\Src\Service\User;
use GameApi\Src\Http\Request;
use GameApi\Src\Http\JsonResponse;

class AuthController
{
    public function signup(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['username']) || empty($data['password'])){
            $responseData = ['status' => 'error', 'message' => 'username and password are required.'];
            $response = new JsonResponse();
            return $response->getResponse($responseData);
        }

        $auth = new Auth();
        $id = $auth->signup($data['username'], $data['password']);

        $user = new User();
        $userData = $user->find($id);

        $responseData = [
            'status' => 'success',
            'result' => [
                'id' => $id,
                'username' => $userData['username'],
                'password' => $userData['password']
            ]
        ];
        $response = new JsonResponse();
        return $response->getResponse($responseData);
    }

    public function signin(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['username']) || empty($data['password'])){
            $responseData = ['status' => 'error', 'message' => 'username and password are required.'];
            $response = new JsonResponse();
            return $response->getResponse($responseData);
        }

        $auth = new Auth();
        if(!$id = $auth->signin($data['username'], $data['password'])){
            $responseData = ['status' => 'error', 'message' => 'username or password is invalid.'];
            $response = new JsonResponse();
            return $response->getResponse($responseData);
        }

        $user = new User();
        $userData = $user->find($id);
        $responseData = [
            'status' => 'success',
            'result' => [
                'id' => $id,
                'username' => $userData['username']
            ]
        ];
        $response = new JsonResponse();
        return $response->getResponse($responseData);
    }
}
