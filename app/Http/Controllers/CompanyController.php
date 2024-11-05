<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * List all admin companies
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $companies = $this->companyService->index();
        if (count($companies) == 0) {
            return ApiResponse::error([], 'No companies found');
        }
        return ApiResponse::success($companies->toArray(), 'Companies retrieved successfully');
    }

    /**
     * Create a company
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:80|unique:companies',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $company = $this->companyService->create($args);
        return ApiResponse::success($company->toArray(), 'Company created successfully');
    }

    /**
     * Company show
     * @param string $uuid
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse
    {
        $company = $this->companyService->show($uuid);
        return ApiResponse::success($company->toArray(), 'Company retrieved successfully');
    }

    /**
     * Update a company
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:80',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'id' => $uuid,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $updated = $this->companyService->update($args);

        if (!$updated) {
            return ApiResponse::error([], 'Company with uuid ' . $uuid . 'can not be updated!');
        }
        return ApiResponse::success([], 'Company with uuid ' . $uuid . ' has been updated!');
    }

    /**
     * Delete a company
     * @param string $uuid
     * @return JsonResponse
     */
    public function destroy(string $uuid): JsonResponse
    {
        $deleted = $this->companyService->delete($uuid);
        if (!$deleted) {
            return ApiResponse::error([], 'Company with uuid ' . $uuid . ' can not be deleted or not exists!');
        }
        return ApiResponse::success([], 'Company with uuid ' . $uuid . ' has been deleted!');
    }
}
