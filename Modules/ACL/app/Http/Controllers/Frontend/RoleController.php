<?php

namespace Modules\ACL\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\ACL\Services\RoleService;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $roles = $this->roleService->getPaginatedRoles();
        return response()->json([
            'data' => $roles,
            'message' => 'Roles retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $role = $this->roleService->createRole($request->validated());
        return response()->json([
            'data' => $role,
            'message' => 'Role created successfully'
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        $role = $this->roleService->getRoleById($id);
        return response()->json([
            'data' => $role,
            'message' => 'Role retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->roleService->updateRole($id, $request->validated());
        $role = $this->roleService->getRoleById($id);
        return response()->json([
            'data' => $role,
            'message' => 'Role updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->roleService->deleteRole($id);
        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }
}
