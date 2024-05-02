<?php

namespace App\Helpers;

class MessageHelper{
    public static function error($status, $msg){
        return response()->json([
            'status'=> $status,
            'message'=> $msg,
        ], 200);
    } 

    public static function resulAuth($status, $msg, $data, $responCode, $token){
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $data,
            'token' => $token,
        ], $responCode);
    }
}