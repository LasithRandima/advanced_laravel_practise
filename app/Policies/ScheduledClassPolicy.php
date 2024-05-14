<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $schedule)
    {
        return $user->id === $schedule->instructor_id;
    }
}
