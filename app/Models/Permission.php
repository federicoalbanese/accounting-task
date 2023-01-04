<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Permission
 *
 * @package App\Models
 * @property integer   id
 * @property string    uuid
 * @property string    title
 * @property string    action
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Permission extends Model
{
    /**
     * The roles that belong to the permission.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
