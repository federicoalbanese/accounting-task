<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoleTrait
{

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param array $roles
     *
     * @return boolean
     */
    public function hasAnyRole(array $roles): bool
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole(string $role): bool
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * @param string $role
     *
     * @return boolean
     */
    public function hasNotRole(string $role): bool
    {
        return null === $this->roles()->where('name', $role)->first();
    }

    /**
     * Permissions
     *
     * @param string $action
     *
     * @return boolean
     */
    public function hasPermissions(string $action): bool
    {
        $foundPermissionsCount = $this->roles()
            ->whereHas('permissions', function(Builder $builder) use ($action) {
                return $builder->where('action', $action);
            })->count();

        return $foundPermissionsCount > 0;
    }

    /**
     * @param integer|Role $role
     */
    public function attachRole(Role|int $role): void
    {
        $this->roles()->attach($role);
    }

    /**
     * @param integer|Role $role
     */
    public function detachRole(Role|int $role): void
    {
        $this->roles()->detach([$role]);
    }

    /**
     * @param array $roles
     */
    public function syncRoles(array $roles): void
    {
        $this->roles()->sync($roles);
    }
}
