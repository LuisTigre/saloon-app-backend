<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController; // This should be used here
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController // Change this to BaseController
{
    // Constructor to apply authorization middleware
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        // Check if the user has the 'admin' permission to view users list
        $this->authorize('viewAny', User::class);

        return User::all();
    }

    public function show(User $user)
    {
        // Check if the user is allowed to view their profile or the target profile
        $this->authorize('update', $user);

        return $user;
    }

    public function update(Request $request, User $user)
    {
        // Check if the user can update the target user
        $this->authorize('update', $user);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user->update($validatedData);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        // Check if the user can delete the target user
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function changePassword(Request $request, User $user)
    {
        // Check if the user is authorized to change password
        $this->authorize('update', $user);

        $request->validate([
            'password' => 'required|string|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function activateAccount(User $user)
    {
        // Only admin can activate a user
        $this->authorize('activate', $user);

        $user->status = 'active';
        $user->save();

        return response()->json(['message' => 'User activated successfully']);
    }

    public function deactivateAccount(User $user)
    {
        // Only admin can deactivate a user
        $this->authorize('deactivate', $user);

        $user->status = 'inactive';
        $user->save();

        return response()->json(['message' => 'User deactivated successfully']);
    }

    public function restoreAccount(User $user)
    {
        // Only admin can restore a deleted user
        $this->authorize('update', $user);

        $user->restore();

        return response()->json(['message' => 'User restored successfully']);
    }

    public function softDelete(User $user)
    {
        // Check if the user can delete the target user
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User soft-deleted successfully']);
    }
}
