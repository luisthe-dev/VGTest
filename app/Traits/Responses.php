<?php

namespace App\Traits;


trait Responses
{
    private static function sendCreated(String $message = '', $data = [])
    {
        return response()->json(['status' => "success", 'message' => $message, 'data' => $data], 201);
    }

    private static function sendSuccess(String $message = '', $data = [])
    {
        return response()->json(['status' => "success", 'message' => $message, 'data' => $data]);
    }

    private static function sendBadRequestError(String $message = '', $data = [], $status = 400)
    {
        return response()->json(['status' => "failed", 'message' => $message, 'data' => $data], $status);
    }

    private static function buildResponseBody(String $status = "failed", String $message = '', $data = [])
    {
        return array('status' => $status, "message" => $message, "data" => $data);
    }

    private static function returnOnStatus($returnObject)
    {
        return $returnObject['status'] == 'failed' ? self::sendBadRequestError($returnObject['message'], $returnObject['data']) : self::sendSuccess($returnObject['message'], $returnObject['data']);
    }
}
