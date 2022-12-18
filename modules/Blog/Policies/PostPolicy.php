<?php

namespace Modules\Blog\Policies;

use App\Models\Role;
use App\Models\User;
use Modules\Blog\Models\Post;

class PostPolicy
{

    public function create(User $user): bool
    {
        return $this->checkRole(Role::ROLE_WRITER, $user);
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
        return $this->checkRole(Role::ROLE_ADMINISTRATOR, $user) || $this->checkRole(Role::ROLE_MODERATOR, $user);
    }

    protected function checkRole(string $role, User $user): bool
    {
        return in_array($role, data_get($user->roles, '*.role'));
    }
}
