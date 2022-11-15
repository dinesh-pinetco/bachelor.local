<?php

namespace App\Http\Controllers;

use App\Mail\MailTemplate;
use App\Models\User;
use App\Notifications\System\ErrorNotification;
use App\Services\SelectionTests\Cubia;
use App\Services\SelectionTests\Moodle;
use Exception;
use Illuminate\Support\Facades\Mail;

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
}
