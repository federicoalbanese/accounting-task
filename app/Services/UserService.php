<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\PersonalAccessTokenResult;

class UserService
{
    private User $user;

    /**
     * @param string $email
     *
     * @return $this
     */
    public function findUserByEmail(string $email): UserService
    {
        $this->user = User::query()
            ->where('email', '=', $email)
            ->first();

        return $this;
    }

    /**
     * @return PersonalAccessTokenResult
     */
    public function generateAccessToken(): PersonalAccessTokenResult
    {
        return $this->user->createToken('access token');
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function syncRole(string $role): UserService
    {
        $this->user->syncRoles([$this->findRole($role)]);

        return $this;
    }

    /**
     * @param string $role
     *
     * @return Builder|Role
     */
    private function findRole(string $role): Builder|Role
    {
        return Role::query()
            ->where('name', '=', $role)
            ->first();
    }
}