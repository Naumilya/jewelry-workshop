<?php

// app/Http/Controllers/CaptchaController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CaptchaController extends Controller
{
    public function verify(Request $request)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->token,
            'remoteip' => $request->ip(),
        ]);

        return $response->json();
    }
}

