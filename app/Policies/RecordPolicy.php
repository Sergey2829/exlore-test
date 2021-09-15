<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Record $record)
    {
        return $user->id === $record->user_id;
    }

    public function delete(User $user, Record $record)
    {
        return ($user->id === $record->user_id) || ($user->id === $record->user->manager_id);
    }

    public function create(User $user)
    {
        return !$user->is_manager;
    }
}
