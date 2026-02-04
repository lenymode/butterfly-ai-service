<?php

namespace Modules\ACL\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ACL\Services\RoleService;
use Modules\ACL\Services\PermissionService;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService,
        protected PermissionService $permissionService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getPaginatedRoles();
        return view('acl::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('acl::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = $this->roleService->createRole($validated);
        
        if ($request->has('permissions')) {
            $this->roleService->syncPermissions($role->id, $request->permissions);
        }

        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $role = $this->roleService->getRoleWithPermissions($id);
        return view('acl::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = $this->roleService->getRoleWithPermissions($id);
        $permissions = $this->permissionService->getAllPermissions();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('acl::roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        $this->roleService->updateRole($id, $validated);
        
        if ($request->has('permissions')) {
            $this->roleService->syncPermissions($id, $request->permissions);
        }

        return redirect()->route('role.show', $id)->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->roleService->deleteRole($id);
        return redirect()->route('role.index')->with('success', 'Role deleted successfully');
    }
}
