<?php

namespace Modules\User\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getPaginatedUsers();
        return response()->json([
            'data' => $users,
            'message' => 'Users retrieved successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'message' => 'Create form data'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json([
            'data' => $user,
            'message' => 'User created successfully'
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        return response()->json([
            'data' => $user,
            'message' => 'User retrieved successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        return response()->json([
            'message' => 'Edit form data'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->userService->updateUser($id, $request->validated());
        $user = $this->userService->getUserById($id);
        return response()->json([
            'data' => $user,
            'message' => 'User updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->userService->deleteUser($id);
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
