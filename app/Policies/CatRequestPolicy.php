<?php

namespace App\Policies;

use App\Models\CatRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CatRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CatRequest $catRequest): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CatRequest $catRequest): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CatRequest $catRequest): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }

    public function deleteAny(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager;
    }
}
