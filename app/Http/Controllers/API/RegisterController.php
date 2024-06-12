<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['created_at'] = $user->created_at;

        return $this->sendResponse($success, 'Вы успешно зарегистрировались.');
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if (!$user) {
                return $this->sendError('Пользователь не авторизован.', ['error' => 'User not authenticated.']);
            }
            if (!method_exists($user, 'createToken')) {
                return $this->sendError('Method createToken does not exist.', ['error' => 'Method createToken does not exist.']);
            }
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['created_at'] = $user->created_at;

            return $this->sendResponse($success, 'Вы успешно залогинились.');
        } else {
            return $this->sendError('Вы не авторизовались, неправильная почта или пароль.', ['error' => 'Unauthorized.']);
        }
    }
}
