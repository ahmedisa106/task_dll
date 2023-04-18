<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Determine whether the Admin can view any models.
     */
    public function viewAny(Admin $Admin): bool
    {
        //
    }

    /**
     * Determine whether the Admin can view the model.
     */
    public function view(Admin $Admin, Category $category): bool
    {
        $auth_categories = $Admin->categories->pluck('id')->toArray();
        return in_array($category->id, $auth_categories);
    }

    /**
     * Determine whether the Admin can create models.
     */
    public function create(Admin $Admin): bool
    {
        //
    }

    /**
     * Determine whether the Admin can update the model.
     */
    public function update(Admin $Admin, Category $category): bool
    {
        $auth_categories = $Admin->categories->pluck('id')->toArray();
        return in_array($category->id, $auth_categories);
    }

    /**
     * Determine whether the Admin can delete the model.
     */
    public function delete(Admin $Admin, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the Admin can restore the model.
     */
    public function restore(Admin $Admin, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the model.
     */
    public function forceDelete(Admin $Admin, Category $category): bool
    {
        //
    }

    public function before(Admin $admin)
    {
        if ($admin->is_super_admin) {
            return true;
        };

    }


}
