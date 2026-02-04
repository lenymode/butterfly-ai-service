<?php

namespace Modules\User\Services;

use Modules\User\app\Models\User;
use Modules\User\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user with validation.
     */
    public function createUser(array $data): User
    {
        // Add business logic here if needed
        return $this->userRepository->create($data);
    }

    /**
     * Update a user with validation.
     */
    public function updateUser(int $id, array $data): bool
    {
        // Add business logic here if needed
        return $this->userRepository->update($id, $data);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Get user by ID.
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Get all users.
     */
    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    /**
     * Get paginated users.
     */
    public function getPaginatedUsers(int $perPage = 15)
    {
        return $this->userRepository->paginate($perPage);
    }
}
