<?php

namespace Modules\ACL\Repositories;

use Modules\ACL\Models\Role;
use Modules\ACL\Contracts\RoleInterface;

class RoleRepository implements RoleInterface
{
    /**
     * Create a new role.
     */
    public function create(array $data)
    {
        return Role::create($data);
    }

    /**
     * Update a role.
     */
    public function update(int $id, array $data): bool
    {
        return Role::findOrFail($id)->update($data);
    }

    /**
     * Delete a role.
     */
    public function delete(int $id): bool
    {
        return Role::findOrFail($id)->delete();
    }

    /**
     * Find a role by ID.
     */
    public function find(int $id): ?Role
    {
        return Role::find($id);
    }

    /**
     * Get all roles.
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * Get paginated roles.
     */
    public function paginate(int $perPage = 15)
    {
        return Role::paginate($perPage);
    }

    /**
     * Sync permissions to a role.
     */
    public function syncPermissions(int $roleId, array $permissionIds): bool
    {
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($permissionIds);
        return true;
    }

    /**
     * Get role with permissions.
     */
    public function findWithPermissions(int $id)
    {
        return Role::with('permissions')->findOrFail($id);
    }
}
