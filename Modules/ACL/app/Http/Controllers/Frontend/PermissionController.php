<?php

namespace Modules\ACL\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\ACL\Services\PermissionService;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $permissionService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $permissions = $this->permissionService->getPaginatedPermissions();
        return response()->json([
            'data' => $permissions,
            'message' => 'Permissions retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $permission = $this->permissionService->createPermission($request->validated());
        return response()->json([
            'data' => $permission,
            'message' => 'Permission created successfully'
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        $permission = $this->permissionService->getPermissionById($id);
        return response()->json([
            'data' => $permission,
            'message' => 'Permission retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->permissionService->updatePermission($id, $request->validated());
        $permission = $this->permissionService->getPermissionById($id);
        return response()->json([
            'data' => $permission,
            'message' => 'Permission updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->permissionService->deletePermission($id);
        return response()->json([
            'message' => 'Permission deleted successfully'
        ]);
    }
}
