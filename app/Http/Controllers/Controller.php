<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result, $massage)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $massage
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMassages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];

        if (!empty($errorMassages)) {
            $response['data'] = $errorMassages;
        }

        return response()->json($response, 200);
    }
}
