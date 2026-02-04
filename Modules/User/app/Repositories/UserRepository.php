<?php

namespace Modules\User\Repositories;

use Modules\User\app\Models\User;
use Modules\User\Contracts\UserInterface;

class UserRepository implements UserInterface
{
    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update a user.
     */
    public function update(int $id, array $data): bool
    {
        return User::findOrFail($id)->update($data);
    }

    /**
     * Delete a user.
     */
    public function delete(int $id): bool
    {
        return User::findOrFail($id)->delete();
    }

    /**
     * Find a user by ID.
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Get all users.
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Get paginated users.
     */
    public function paginate(int $perPage = 15)
    {
        return User::paginate($perPage);
    }
}
