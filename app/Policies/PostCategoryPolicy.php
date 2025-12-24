<?php

namespace App\Policies;

use App\Models\PostCategory;
use App\Models\User;

class PostCategoryPolicy
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
    public function view(User $user, PostCategory $postCategory): bool
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
    public function update(User $user, PostCategory $postCategory): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostCategory $postCategory): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }

    public function deleteAny(User $user): bool
    {
        return $user->is_admin || $user->is_sales_manager || $user->is_editor;
    }
}
