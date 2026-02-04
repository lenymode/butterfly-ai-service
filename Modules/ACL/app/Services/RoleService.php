<?php

namespace Modules\ACL\Services;

use Modules\ACL\Repositories\RoleRepository;

class RoleService
{
    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Create a new role with validation.
     */
    public function createRole(array $data)
    {
        // Add business logic here if needed
        return $this->roleRepository->create($data);
    }

    /**
     * Update a role with validation.
     */
    public function updateRole(int $id, array $data): bool
    {
        // Add business logic here if needed
        return $this->roleRepository->update($id, $data);
    }

    /**
     * Delete a role.
     */
    public function deleteRole(int $id): bool
    {
        return $this->roleRepository->delete($id);
    }

    /**
     * Get role by ID.
     */
    public function getRoleById(int $id)
    {
        return $this->roleRepository->find($id);
    }

    /**
     * Get all roles.
     */
    public function getAllRoles()
    {
        return $this->roleRepository->all();
    }

    /**
     * Get paginated roles.
     */
    public function getPaginatedRoles(int $perPage = 15)
    {
        return $this->roleRepository->paginate($perPage);
    }

    /**
     * Sync permissions to a role.
     */
    public function syncPermissions(int $roleId, array $permissionIds): bool
    {
        return $this->roleRepository->syncPermissions($roleId, $permissionIds);
    }

    /**
     * Get role with permissions.
     */
    public function getRoleWithPermissions(int $id)
    {
        return $this->roleRepository->findWithPermissions($id);
    }
}
