<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // qualquer usuário autenticado pode listar suas ideias
    }

    public function view(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id; //só pode ver se for o dono da ideia
    }

    public function create(User $user): bool
    {
        return true; //pode criar ideias
    }

    public function update(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id;
    }

    public function delete(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id;
    }
}
