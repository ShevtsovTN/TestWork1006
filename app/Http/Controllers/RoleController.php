<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Service\RoleService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    private RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * Дать роль пользователю.
     *
     * @param User $user
     * @param RoleRequest $roleRequest
     * @return JsonResponse
     * @throws AuthorizationException|Exception
     */
    public function attachRole(User $user, RoleRequest $roleRequest): JsonResponse
    {
        auth()->user()->can('update_role');
        return response()->json($this->service->attachRole($user, $roleRequest->validated()));
    }

    /**
     * Удалить роль пользователя.
     *
     * @param User $user
     * @param RoleRequest $roleRequest
     * @return JsonResponse
     * @throws AuthorizationException|Exception
     */
    public function detachRole(User $user, RoleRequest $roleRequest): JsonResponse
    {
        auth()->user()->can('update_role');
        return response()->json($this->service->detachRole($user, $roleRequest->validated()));
    }
}
