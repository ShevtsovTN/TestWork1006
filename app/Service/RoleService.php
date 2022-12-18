<?php

namespace App\Service;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService
{

    /**
     * @throws Exception
     */
    public function attachRole(User $user, array $validated): User
    {
        $roleValue = $validated['role'];
        if (!$this->isAttachable($user, $roleValue)) {
            throw new Exception('User already have this role.', 400);
        }
        DB::beginTransaction();
        try {
            $role = Role::query()->where('role', $roleValue)->first();
            $user->roles()->attach($role);
            DB::commit();

            return $user->load(['roles']);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function detachRole(User $user, array $validated): User
    {
        $roleValue = $validated['role'];
        if ($this->isAttachable($user, $roleValue)) {
            throw new Exception('User don`t have this role.', 400);
        }
        if (!$this->isDetachable($user)) {
            throw new Exception('The user must have at least one role.', 400);
        }
        DB::beginTransaction();
        try {
            $role = Role::query()->where('role', $roleValue)->first();
            $user->roles()->detach($role);

            DB::commit();

            return $user->load(['roles']);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    protected function isAttachable(User $user, string $role): bool
    {
        return !in_array($role, data_get($user->roles, '*.role'));
    }

    protected function isDetachable(User $user): bool
    {
        return $user->roles()->count() > 1;
    }
}
