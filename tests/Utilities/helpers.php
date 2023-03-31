<?php

use App\Imports\CubiaResultImport;
use App\Models\Result;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

function create($class, $attributes = [], $times = null)
{
    return $class::factory()->count($times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return $class::factory()->count($times)->make($attributes);
}

function seed_fake_test_results(User $user)
{
    $tests = Test::all();
    foreach ($tests as $test) {
        if ($test->type == Test::TYPE_MOODLE) {
            seed_fake_moodle_result($user, $test);
        }

        if ($test->type == Test::TYPE_CUBIA) {
            seed_fake_cubia_result($user, $test);
        }

        if ($test->type == Test::TYPE_METEOR) {
            seed_fake_meteor_result($user, $test);
        }
    }
}

function seed_fake_cubia_result(User $user, Test $test)
{
    $user->update(['cubia_id' => 'TESTAPPLICANT']);

    $result = \App\Models\Result::factory()->create([
        'user_id' => $user,
        'test_id' => $test->id,
        'status' => Result::STATUS_STARTED,
    ]);

    $fileName = 'cubia-test-result.csv';

    if (! Storage::exists($fileName)) {
        Storage::put($fileName, file_get_contents('tests/Utilities/cubia-test-result.csv'));
    }

    Excel::import(new CubiaResultImport(), $fileName);
}

function seed_fake_meteor_result(User $user, Test $test)
{
    $result = \App\Models\Result::factory()->create([
        'user_id' => $user,
        'test_id' => $test->id,
    ]);

    $responseJson = json_decode('{
"viq-3":{
"dimensions":{
"s":95,
"n":75,
"t":84,
"f":19,
"j":55,
"e":14,
"i":86,
"p":45
},
"absolute":{
"s":3,
"n":3,
"t":4,
"f":0,
"j":3,
"e":5,
"i":20,
"p":22
},
"short":"ST",
"full":"ISTJ",
"short_psi":"SO",
"full_psi":"SO1"
},
"meta_data":{
"tan":"e45caacba5dfbcf8",
"project_id":"d9276c06-70b2-4447-b3fa-a6ff57881085",
"started_at":"2022-04-17T11:49:17.040Z",
"finished_at":"2022-04-17T11:56:15.998Z",
"report_url":"https://kern.viq16.com/api/transaction/result_report?p=d9276c06-70b2-4447-b3fa-a6ff57881085&t=e45caacba5dfbcf8&l=de&d=viq-3-1.pdf",
"user_agent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36",
"form_data":"{\"naTan\":\"1488-593654\"}"
}
}');
    $grade = data_get($responseJson, 'viq-3.full');

    $result->updateTestResult((bool) $grade, data_get($responseJson, 'meta_data.report_url'), $responseJson);
}

function seed_fake_moodle_result(User $user, Test $test)
{
    $result = \App\Models\Result::factory()->create([
        'user_id' => $user,
        'test_id' => $test->id,
    ]);

    $grade = rand(80, 90);
    $result->updateTestResult($grade, $grade, []);
}
