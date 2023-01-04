<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 *
 * @package App\Models
 * @property integer id
 * @property string  name
 * @property string  description
 */
class Role extends Model
{

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param integer|Permission $permission
     */
    public function attachPermission($permission)
    {
        $this->permissions()->attach($permission);
    }

    /**
     * @param array $permissions
     */
    public function attachPermissions(array $permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * @param integer|Permission $permission
     */
    public function detachPermission($permission)
    {
        $this->permissions()->detach($permission);
    }

    /**
     * @param array $permissions
     */
    public function detachPermissions(array $permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * @return array
     */
    public function permissionsArray(): array
    {
        return $this->permissions()->get()->toArray();
    }

    /**
     * Permissions
     *
     * @param string $action
     *
     * @return boolean
     */
    public function hasPermission(string $action): bool
    {
        return $this->permissions()->where('action', $action)->exists();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return \App\User\Entities\Role
     */
    public function setName(string $name): Role
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Role
     */
    public function setDescription(string $description): Role
    {
        $this->description = $description;

        return $this;
    }
}
