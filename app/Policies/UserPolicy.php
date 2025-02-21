<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can update the given user.
     */
    public function update(User $authUser, User $user)
    {
        // Allow the user to update their own account or if they are an admin
        return $authUser->id === $user->id || $authUser->role === 'admin';
    }

    /**
     * Determine if the given user can delete the given user.
     */
    public function delete(User $authUser, User $user)
    {
        // Allow the user to delete their own account or if they are an admin
        return $authUser->id === $user->id || $authUser->role === 'admin';
    }

    /**
     * Determine if the given user can view the user list (admin only).
     */
    public function viewAny(User $authUser)
    {
        return $authUser->role === 'admin';
    }

    /**
     * Determine if the given user can activate the account.
     */
    public function activate(User $authUser, User $user)
    {
        return $authUser->role === 'admin';
    }

    /**
     * Determine if the given user can deactivate the account.
     */
    public function deactivate(User $authUser, User $user)
    {
        return $authUser->role === 'admin';
    }
}
