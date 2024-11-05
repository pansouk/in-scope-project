<?php

namespace App\Http\Controllers;


use App\Helpers\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;


class SessionController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /**
     * Login user
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $attempt = $this->service->login(request('email'), request('password'));

        if (array_key_exists('error', $attempt)) {
            return ApiResponse::error($attempt);
        }
        return ApiResponse::success($attempt, 'Successfully logged in');
    }
}
