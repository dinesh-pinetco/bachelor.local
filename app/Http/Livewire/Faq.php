<?php

namespace App\Http\Livewire;

use App\Models\Faq as ModelsFaq;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        $course_ids = auth()->user()->courses()->pluck('course_id');

        return view('livewire.faq', [
            'faq' => ModelsFaq::whereHas('courses', function ($query) use ($course_ids) {
                $query->whereIn('course_id', $course_ids);
            })->orderBy('sort_order')->get(),
        ]);
    }
}
