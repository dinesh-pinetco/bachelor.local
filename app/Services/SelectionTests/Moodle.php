<?php

namespace App\Services\SelectionTests;

use App\Models\Moodle as MoodleModel;
use App\Models\Result;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Moodle
{
    const ROLL_ID = 5;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser()
    {
        if (! $this->user->moodle) {
            $idNumber = $this->generateIdNumber();
            $url = config('services.moodle.base_url').
                '&wsfunction=core_user_create_users'.
                '&moodlewsrestformat=json'.
                '&users[0][username]='.$this->generateUsername().
                '&users[0][firstname]='.$this->user->first_name.
                '&users[0][lastname]='.$this->user->last_name.
                '&users[0][email]='.$this->generateUsername().'@awt.nordakademie.de'.
                '&users[0][idnumber]='.$idNumber.
                '&users[0][password]='.'1SecretPassword!';
            $response = Http::get($url);
            $responseJson = $response->json();

            if (data_get($responseJson, 'exception')) {
                Log::error('Moodle Create-user API response: ', [
                    'requested_url' => $url,
                    'response' => $responseJson,
                    'user' => $this->user,
                ]);

                return 'Moodle: '.str_replace('error/', '', html_entity_decode(data_get($responseJson, 'debuginfo')));
            } else {
                MoodleModel::create([
                    'id' => data_get($responseJson, '0.id'),
                    'user_id' => $this->user->id,
                    'id_number' => $idNumber,
                    'username' => data_get($responseJson, '0.username'),
                ]);
            }
        }
    }

    protected function generateIdNumber(): string
    {
        $appEnv = config('app.env');
        $prefix = $appEnv == 'production' ? 'NAKP' : ($appEnv == 'staging' ? 'NAKS' : 'NAKL');

        return implode('_', [$prefix, time(), $this->user['id']]);
    }

    protected function generateUsername(): array|string
    {
        return iconv('utf-8', 'ascii//TRANSLIT', str_replace(' ', '_', implode('_', [strtolower($this->user['first_name']), strtolower($this->user['last_name']), time()])));
    }

    public function attachCourseToUser(Test $test): array|bool|string
    {
        $this->user->load('moodle');

        if ($test) {
            Result::updateOrCreate(
                ['user_id' => $this->user->id, 'test_id' => $test->id],
                ['status' => Result::STATUS_NOT_STARTED]
            );
        }

        if ($this->user->moodle) {
            $url = config('services.moodle.base_url').
                '&wsfunction=enrol_manual_enrol_users'.
                '&moodlewsrestformat=json'.
                '&enrolments[0][roleid]='.self::ROLL_ID.
                '&enrolments[0][userid]='.data_get($this->user->moodle, 'id').
                '&enrolments[0][courseid]='.$test->course_id;

            $response = Http::get($url);
            $responseJson = $response->json();

            if (data_get($responseJson, 'exception')) {
                Log::error('Moodle Attach-course API response: ', [
                    'requested_url' => $url,
                    'response' => $responseJson,
                    'user' => $this->user,
                ]);

                return str_replace('error/', '', html_entity_decode(data_get($responseJson, 'message')));
            }

            return true;
        }

        return false;
    }

    public function generateTestUrl()
    {
        if ($this->user->moodle) {
            $url = config('services.moodle.base_url').
                '&wsfunction=auth_userkey_request_login_url'.
                '&moodlewsrestformat=json'.
                '&user[idnumber]='.data_get($this->user->moodle, 'id_number');

            $response = Http::get($url);
            $responseJson = $response->json();

            if (data_get($responseJson, 'exception')) {
                Log::error('Moodle Generate-test-url API response: ', [
                    'requested_url' => $url,
                    'response' => $responseJson,
                    'user' => $this->user,
                ]);

                return str_replace('error/', '', html_entity_decode(data_get($responseJson, 'message')));
            }

            return data_get($responseJson, 'loginurl');
        }
    }

    public function fetchResult(Result $result)
    {
        $result->load('test');
        if ($this->user->moodle) {
            $url = config('services.moodle.base_url').
                '&wsfunction=gradereport_user_get_grades_table'.
                '&moodlewsrestformat=json'.
                '&userid='.data_get($this->user->moodle, 'id').
                '&courseid='.data_get($result->test, 'course_id');

            $response = Http::get($url);
            $responseJson = $response->json();

            if (data_get($responseJson, 'exception')) {
                return str_replace('error/', '', html_entity_decode(data_get($responseJson, 'message')));
            }

            $tableData = data_get($responseJson, 'tables.0.tabledata');

            $grade = data_get(end($tableData), 'grade.content');

            $result->updateTestResult($grade, $grade, $responseJson);

            return $grade;
        }
    }
}
