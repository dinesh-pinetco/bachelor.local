<?php

namespace App\Http\Controllers;

use App\Models\Meteor;
use App\Models\Result;
use App\Models\Test;
use App\Services\Meteor as MeteorServices;

class SelectionTestController extends Controller
{
    public function index()
    {
        $t = request('t');
        $f = request('f');

        if ($t && $f) {
            $naTan = trim(data_get(json_decode($f, true), 'naTan'), '{}');
            $meteor = Meteor::where('na_tan', $naTan)->where('user_id', auth()->id())->first();
            if ($meteor) {
                $meteor->t = $t;
                $meteor->save();
                $this->setResult(auth()->user());
            }
        }

        $courses = auth()->user()->courses->pluck('id')->toArray();

        $tests = Test::matchCourses($courses)->get();

        return view('selection-test', compact('tests'));
    }

    public function setResult($user)
    {
        $selectionTest = Test::where('type', Test::TYPE_METEOR)->where('is_active', true)->first();

        $result = $selectionTest->results()->myResults($user)
            ->where('status', Result::STATUS_STARTED)
            ->where('is_passed', 0)
            ->first();

        if ($result) {
            (new MeteorServices($user))->fetchResult($result);
        }

        $user->saveApplicationStatus();
    }
}
