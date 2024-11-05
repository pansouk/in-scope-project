<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected ProjectService  $projectService;

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
}
