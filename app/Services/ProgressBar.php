<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Tab;
use App\Models\Test;
use App\Models\User;

class ProgressBar
{
    public $applicant;

    public mixed $applicant_id;

    public function __construct($applicant_id = null)
    {
        $this->applicant_id = $applicant_id;
        $this->applicant = is_null($this->applicant_id) ? auth()->user() : (User::find($this->applicant_id) ?? auth()->user());
    }

    public function overAllProgress(): float
    {
        $progressPoints = $this->calculateProgressByTab('profile')
            + $this->selectionTestsProgress()
            + $this->calculateProgressByTab('industries')
            + $this->calculateProgressByTab('motivation')
            + $this->documentProgress();

        return round($progressPoints);
    }

    public function calculateProgressByTab($tabSlug): float|int
    {
        $tab = Tab::where('slug', $tabSlug)->first();
        $points = $tab->fields->where('is_required')->count();

        $achievedPoints = $tab->fields()
            ->where('is_required', true)
            ->whereHas('values', function ($q) {
                return $q->where('user_id', $this->applicant->id)
                    ->where(function ($q) {
                        $q->whereNotNull('value')->where('value', '<>', '');
                    })->orWhere(function ($q) {
                        $q->whereNotNull('option_id')->where('option_id', '<>', '');
                    });
            })->count();

        return $this->calculateAverageProcess($points, $achievedPoints);
    }

    private function calculateAverageProcess($points, $achievedPoints): float|int
    {
        return $points ? round(($achievedPoints * PER_STEP_PROGRESS) / $points, 2) : ($achievedPoints ? 0 : 25);
    }

    public function documentProgress(): float|int
    {
        $courseIds = $this->applicant->courses()->pluck('course_id');
        $points = Document::active()
            ->required()
            ->whereHas('courses', function ($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })->count();

        $achievedPoints = Document::active()
            ->required()
            ->whereHas('medias', function ($q) {
                $q->where('user_id', $this->applicant->id);
            })
            ->whereHas('courses', function ($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })->count();

        return $this->calculateAverageProcess($points, $achievedPoints);
    }

    public function selectionTestsProgress(): float|int
    {
        $courses = $this->applicant->courses->pluck('course_id')->toArray();
        $points = count(Test::categories());

        $firstCategoryPoint = Test::query()
            ->where('category', Test::FIRST_CATEGORY)
            ->matchCourses($courses)
            ->whereHas('results', function ($q) {
                $q->where('user_id', $this->applicant->id)
                    ->where('is_passed', true);
            })->exists();

        $secondCategoryPoint = Test::query()
            ->where('category', Test::SECOND_CATEGORY)
            ->matchCourses($courses)
            ->whereHas('results', function ($q) {
                $q->where('user_id', $this->applicant->id)
                    ->where('is_passed', true);
            })->exists();

        $achievedPoints = (intval($firstCategoryPoint) + intval($secondCategoryPoint));

        return $this->calculateAverageProcess($points, $achievedPoints);
    }
}
