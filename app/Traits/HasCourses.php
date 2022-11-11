<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\ModelHasCourse;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCourses
{
    public function attachCourses($courses): static
    {
        $this->courses()->sync($courses);

        return $this;
    }

    /**
     * A model may have multiple professions.
     */
    public function courses(): MorphToMany
    {
        return $this->morphToMany(
            Course::class,
            'model',
            'model_has_courses',
            'model_id',
            'course_id'
        )->whereNull('model_has_courses.deleted_at')->withTimestamps();
    }

    // Course table existing :(
    public function courseModel()
    {
        return $this->morphOne(
            ModelHasCourse::class,
            'model'
        );
    }

    public function attachCourseWithDesiredBeginning($courseId, $desiredBeginning, $courseStartDate): void
    {
        $this->courses()->sync([$courseId => ['desired_beginning_id' => $desiredBeginning, 'course_start_date' => $courseStartDate]]);
        $this->hubspotConfigurationUpdated();
    }

    public function scopeCoursesIn($query, $courseIds = [])
    {
        return $query->whereHas('courses', function ($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        });
    }
}
