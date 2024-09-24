<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\Response;

class ItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasVerifiedEmail() ? Response::allow() : Response::deny("Only verified users can view items.");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Item $item): Response
    {
        if (!$user->hasVerifiedEmail()) {
            return Response::deny("Only verified users can view items.");
        }
        return $user->id === $item->user_id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasVerifiedEmail() ? Response::allow() : Response::deny("Only verified users can create items.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Item $item): Response
    {
        if (!$user->hasVerifiedEmail()) {
            return Response::deny("Only verified users can view items.");
        }

        return $user->id === $item->user_id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Item $item): Response
    {
        if (!$user->hasVerifiedEmail()) {
            return Response::deny("Only verified users can view items.");
        }

        return $user->id === $item->user_id ? Response::allow() : Response::deny();
    }
}
