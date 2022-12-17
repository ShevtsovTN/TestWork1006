<?php

namespace Modules\Blog\Policies;

use App\Models\Role;
use App\Models\User;
use Modules\Blog\Models\Post;

class PostPolicy
{

    public function create(User $user): bool
    {
        return $user->roles == Role::ROLE_WRITER;
    }

    public function update(User $user, Post $post): bool
    {
        return $post->user->is($user) || $this->getEditor($user);
    }

    public function delete(User $user, Post $post): bool
    {
        return $post->user->is($user) || $this->getEditor($user);
    }
    protected function getEditor(User $user): bool
    {
        return $user->roles == Role::ROLE_ADMINISTRATOR || $user->roles == Role::ROLE_MODERATOR;
    }
}
