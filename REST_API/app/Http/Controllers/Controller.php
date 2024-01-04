<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function success($message = "", $data = null, $code = 200){
        if(!$data){
            return response()->json(["message" => $message], $code);
        }

        return response()->json(["success"=> $message,"data"=> $data], $code);
    }

    public function error($message = "", $data = null, $code = 500){
        if (!$data){
            return response()->json(["error"=> $message], $code);
        }

        return response()->json(["error"=> $message,"data"=> $data],$code);
    }
}
