<?php

namespace Modules\ACL\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ACL\Services\PermissionService;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $permissionService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionService->getPaginatedPermissions();
        return view('acl::permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('acl::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $this->permissionService->createPermission($validated);
        return redirect()->route('permission.index')->with('success', 'Permission created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        return view('acl::permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        return view('acl::permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $this->permissionService->updatePermission($id, $validated);
        return redirect()->route('permission.show', $id)->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->permissionService->deletePermission($id);
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully');
    }
}
