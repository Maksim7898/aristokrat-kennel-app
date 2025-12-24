<?php

namespace App\Policies;

use App\Models\CatBreed;
use App\Models\User;

class CatBreedPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CatBreed $catBreed): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CatBreed $catBreed): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CatBreed $catBreed): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    public function deleteAny(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }
}
