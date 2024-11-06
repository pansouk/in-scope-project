<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param string $type
     * @return JsonResponse
     */
    public function index(string $type = 'all'): JsonResponse
    {
        $projects = $this->projectService->index($type);
        return ApiResponse::success($projects->toArray(), 'Projects retrieved successfully.');
    }

    /**
     * Create a project
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required:exists:projects,type',
            'name' => 'required|max:220',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'type' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => $request->company_id,
            'budget' => $request->budget ?? null,
            'timeline' => $request->timeline ?? null,
        ];

        $project = $this->projectService->create($args);

        return ApiResponse::success($project->toArray(), 'Project created successfully.');
    }

    /**
     * @param string $uuid
     * @param string $type
     * @return JsonResponse
     */
    public function show(string $uuid, string $type): JsonResponse
    {
        $validator = Validator::make(
            [
                'id' => $uuid,
                'type' => $type,
            ], [
            'id' => 'required|exists:projects,id',
            'type' => 'required|exists:projects,type',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $project = $this->projectService->show($uuid, $type);
        return ApiResponse::success($project->toArray(), 'Project retrieved successfully.');
    }

    /**
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required:exists:projects,type',
            'name' => 'required|max:220',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validations($validator->errors());
        }

        $args = [
            'id' => $uuid,
            'type' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => $request->company_id,
            'budget' => $request->budget ?? null,
            'timeline' => $request->timeline ?? null,
        ];

        $updated = $this->projectService->update($args);

        if (!$updated) {
            return ApiResponse::error([], 'Project update failed.');
        }
        return ApiResponse::success([], 'Project updated successfully.');
    }

    /**
     * @param string $uuid
     * @param string $type
     * @return JsonResponse
     */
    public function destroy(string $uuid, string $type): JsonResponse
    {
        $deleted = $this->projectService->delete($uuid, $type);
        if (!$deleted) {
            return ApiResponse::error([], 'Project delete failed.');
        }
        return ApiResponse::success([], 'Project deleted successfully.');
    }
}
