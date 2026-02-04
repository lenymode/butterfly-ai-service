<?php

namespace Modules\ACL\Repositories;

use Modules\ACL\Models\Permission;
use Modules\ACL\Contracts\PermissionInterface;
use Modules\ACL\Models\Role;

class PermissionRepository implements PermissionInterface
{
    /**
     * Create a new permission.
     */
    public function create(array $data)
    {
        return Permission::create($data);
    }

    /**
     * Update a permission.
     */
    public function update(int $id, array $data): bool
    {
        return Permission::findOrFail($id)->update($data);
    }

    /**
     * Delete a permission.
     */
    public function delete(int $id): bool
    {
        return Permission::findOrFail($id)->delete();
    }

    /**
     * Find a permission by ID.
     */
    public function find(int $id): ?Permission
    {
        return Permission::find($id);
    }

    /**
     * Get all permissions.
     */
    public function all()
    {
        return Permission::all();
    }

    /**
     * Get paginated permissions.
     */
    public function paginate(int $perPage = 15)
    {
        return Permission::paginate($perPage);
    }

    /**
     * Get permissions by role.
     */
    public function getByRole(int $roleId)
    {
        $role = Role::findOrFail($roleId);
        return $role->permissions;
    }
}
