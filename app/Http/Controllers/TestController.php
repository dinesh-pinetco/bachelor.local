<?php

namespace App\Http\Controllers;

use App\Mail\MailTemplate;
use App\Models\GovernmentForm;
use App\Models\StudySheet;
use App\Models\User;
use App\Notifications\System\ErrorNotification;
use App\Services\SelectionTests\Cubia;
use App\Services\SelectionTests\Moodle;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            abort(404);
        }
    }

    //Note: This is controller to test any code

    public function moodle()
    {
        $user = User::find(11);

        $moodle = (new Moodle($user));
        $moodle->createUser();
        $moodle->attachCourseToUser();
    }

    public function fetchResult()
    {
        (new Cubia())->fetchResult();
    }

    public function moveMeteorId()
    {
        //        $users = User::whereNotNull('meteor_id')->get();
        //        foreach ($users as $user) {
        //            Meteor::create([
        //                'user_id' => $user->id,
        //                'na_tan'  => $user->meteor_id,
        //            ]);
        //        }
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    public function testMail($slug, $email = 'pooja@pinetco.com')
    {
        try {
            if ($slug == 'mail') {
                Mail::to($email)->send(new MailTemplate('This is a test mail...'));

                return 'success';
            } elseif ($slug == 'log') {
                logger('This is a test log...');

                return 'success';
            } elseif ($slug == 'slack') {
                $user = User::where('email', $email)->first();

                ErrorNotification::make(new Exception(), request(), $user)->send();
            }
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function governmentForm(User $user)
    {
        return Redirect::to(URL::signedRoute('government-form', ['user' => $user->id]));
    }

    public function studySheetForm(User $user)
    {
        return Redirect::to(URL::signedRoute('study-sheet', ['user' => $user->id]));
    }

    public function seedStudySheet(User $user)
    {
        StudySheet::factory()->create(['user_id' => $user->id]);

        return response()->json(['message' => 'success']);
    }

    public function seedGovernmentForm(User $user)
    {
        GovernmentForm::factory()->create(['user_id' => $user->id]);

        return response()->json(['message' => 'success']);
    }
}
