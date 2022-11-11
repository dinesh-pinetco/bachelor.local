<?php

namespace App\Http\Livewire\Employee\Courses;

use App\Models\Course;
use App\Models\ModelHasCourse;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedCourse;

    public $column = null;

    public array $columns = Course::SEARCHABLE_FIELDS;

    public function openConfirmModal(Course $course)
    {
        if (ModelHasCourse::whereCourseId($course->id)->exists()) {
            $this->toastNotify(__('Course of study could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        } else {
            $this->open();
            $this->deletedCourse = $course;
        }
    }

    public function delete()
    {
        $this->deletedCourse->delete();
        $this->toastNotify(__('Course deleted successfully.'), __('Success'), TOAST_SUCCESS);
        $this->reset('show', 'deletedCourse');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.courses.index', [
            'courses' => Course::searchByKey($this->column, request('search'))->filter()->paginate($this->perPage),
        ]);
    }
}
