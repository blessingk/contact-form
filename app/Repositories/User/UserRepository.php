<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function get(int $userId): User
    {
        return $this->user->find($userId);
    }

    /**
     * @param array $userData
     * @return User
     */
    public function store(array $userData): User
    {
        return $this->user->create($userData);
    }
}
