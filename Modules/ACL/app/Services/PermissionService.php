<?php

namespace Modules\ACL\Services;

use Modules\ACL\Repositories\PermissionRepository;

class PermissionService
{
    protected PermissionRepository $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Create a new permission with validation.
     */
    public function createPermission(array $data)
    {
        // Add business logic here if needed
        return $this->permissionRepository->create($data);
    }

    /**
     * Update a permission with validation.
     */
    public function updatePermission(int $id, array $data): bool
    {
        // Add business logic here if needed
        return $this->permissionRepository->update($id, $data);
    }

    /**
     * Delete a permission.
     */
    public function deletePermission(int $id): bool
    {
        return $this->permissionRepository->delete($id);
    }

    /**
     * Get permission by ID.
     */
    public function getPermissionById(int $id)
    {
        return $this->permissionRepository->find($id);
    }

    /**
     * Get all permissions.
     */
    public function getAllPermissions()
    {
        return $this->permissionRepository->all();
    }

    /**
     * Get paginated permissions.
     */
    public function getPaginatedPermissions(int $perPage = 15)
    {
        return $this->permissionRepository->paginate($perPage);
    }
}
