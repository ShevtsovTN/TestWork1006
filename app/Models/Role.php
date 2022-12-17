<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'created_at',
        'updated_at'
    ];

    const
        ROLE_ADMINISTRATOR = 'administrator',
        ROLE_MODERATOR = 'moderator',
        ROLE_WRITER = 'writer',
        ROLE_READER = 'reader';


    /**
     * The roles that belong to the user.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'role_user',
            'role_id',
            'user_id'
        );
    }
}
