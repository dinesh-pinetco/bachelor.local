<?php

namespace App\Http\Livewire;

use App\Models\Result;
use App\Models\Test;
use Livewire\Component;

class SelectionTest extends Component
{
    public function render()
    {
        return view('livewire.selection-test', [
            'tests' => Test::query()
                ->matchCourses(auth()->user()->courses->pluck('id')->toArray())
                ->with(['result' => function ($q) {
                    $q->where('user_id', auth()->id());
                }])
                ->get(),
        ]);
    }

    public function startTest($testId)
    {
        Result::updateOrCreate(
            ['user_id' => auth()->id(), 'test_id' => $testId],
            ['status' => Result::STATUS_STARTED]
        );
    }
}
