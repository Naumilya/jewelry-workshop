<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    /**
     * Отправка письма со ссылкой для сброса пароля.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Reset link sent to your email.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to send reset link.',
                'data' => ['error' => 'Unable to send reset link.']
            ], 500);
        }
    }

    /**
     * Отображение формы сброса пароля.
     *
     * @param Request $request
     * @param string $token
     * @param string $email
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        if (!$email) {
            return response()->json(['error' => 'Email is required'], 400);
        }

        // Проверяем, существует ли пользователь с указанным email и токеном
        $decodedEmail = urldecode($email);
        $user = User::whereEmail($decodedEmail)->first();

        if (!$user || !Password::tokenExists($user, $token)) {
            // Если пользователя не существует или токен недействителен, возвращаем ошибку или редиректим
            return response()->json(['error' => 'Invalid token or email'], 400);
        }

        // Возвращаем успешный ответ или необходимые данные
        return response()->json(['message' => 'Token and email are valid', 'token' => $token, 'email' => $decodedEmail]);
    }


    /**
     * Сброс пароля.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        // Сброс пароля
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            // Успешный сброс пароля
            return response()->json([
                'success' => true,
                'message' => 'Password has been reset.',
            ]);
        } else {
            // Ошибка сброса пароля
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password.',
                'data' => ['error' => 'Failed to reset password.']
            ], 500);
        }
    }
}
