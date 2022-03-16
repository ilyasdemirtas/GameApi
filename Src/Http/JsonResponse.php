<?php

namespace GameApi\Src\Http;

class JsonResponse implements Response
{
    /**
     * @param $data
     * @param int $statusCode
     * @return false|string
     */
    public function getResponse($data, $statusCode = 200)
    {
        header("HTTP/1.1 $statusCode");
        header('Content-Type: application/json; charset=utf-8');
        $data['timestamp'] = (new \DateTime())->format('Y-m-d H:i:s');
        return json_encode($data);
    }
}
