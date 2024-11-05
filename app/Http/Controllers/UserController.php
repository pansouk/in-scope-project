<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(string $role = 'all')
    {
        $users = $this->userService->index($role)->toArray();
        return ApiResponse::success($users);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];
        $user = $this->userService->create($args);

        return ApiResponse::success($user->toArray());
    }

    /**
     * Show user
     * @param string $uuid
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse
    {
        $user = $this->userService->show($uuid);
        return ApiResponse::success($user->toArray(), 'Information for User with UUID: ' . $uuid);
    }

    /**
     * Update user
     * @param string $uuid
     * @param Request $request
     * @return JsonResponse
     */
    public function update(string $uuid, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'id' => $uuid,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $updated = $this->userService->update($args);

        if (!$updated) {
            return ApiResponse::error([], 'User with uuid ' . $uuid . 'can not be updated!');
        }
        return ApiResponse::success([], 'User with uuid ' . $uuid . ' has been updated!');
    }


    /**
     * Delete user
     * @param string $uuid
     * @return JsonResponse
     */
    public function destroy(string $uuid): JsonResponse
    {
        $deleted = $this->userService->delete($uuid);
        if (!$deleted) {
            return ApiResponse::error([], 'User with uuid ' . $uuid . 'can not be deleted or not exists!');
        }
        return ApiResponse::success([], 'User with uuid ' . $uuid . ' has been deleted!');
    }
}
