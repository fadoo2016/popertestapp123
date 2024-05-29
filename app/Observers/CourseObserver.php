<?php

namespace App\Observers;

use App\Models\Course;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function creating(Course $course): void
    {
        $userId = auth()->id();

        assert(is_int($userId));

        $course->teacher_user_id = $userId;
    }
}
