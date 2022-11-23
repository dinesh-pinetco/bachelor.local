<?php

namespace App\Http\Livewire;

use App\Models\Faq as ModelsFaq;
use Livewire\Component;

class Faq extends Component
{
    public $faq;

    public function render()
    {
        $this->faq = ModelsFaq::whereHas('courses', function ($query) {
            $query->whereIn('course_id', auth()->user()->desiredBeginning->courses->pluck('id'));
        })->orderBy('sort_order')->get();

        return view('livewire.faq');
    }
}
