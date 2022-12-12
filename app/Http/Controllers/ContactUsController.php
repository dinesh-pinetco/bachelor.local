<?php

namespace App\Http\Controllers;

use App\Mail\ContactSupport;
use App\Models\ContactProfile;
use App\Models\ModelHasCourse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function __invoke()
    {
        $professor = ModelHasCourse::with(['model'])->whereHasMorph(
            'model',
            [ContactProfile::class],
            function (Builder $query) {
                $query->where('course_id', auth()->user()->courses()->first()?->course_id);
            }
        )->first();

        return view('support.contact-us', compact('professor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'min:10'],
        ]);

        Mail::to($request->email)
                ->bcc(config('mail.supporter.address'))
                ->send(new ContactSupport($request->message));

        return back()->with('message', __('Message Sent Successfully!!'));
    }
}
