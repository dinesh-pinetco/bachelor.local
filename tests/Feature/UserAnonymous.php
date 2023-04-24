<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Http\Livewire\Document;
use App\Models\Course;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\User;
use App\Services\MakeAnonymousUser;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAnonymous extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function applicant_information_nullable_after_two_years()
    {

        $this->userCreatedProcess('2020-10-01');

        $this->assertNotNull(auth()->user()->first_name);
        $this->assertNotNull(auth()->user()->last_name);

        $this->assertNotNull(auth()->user()?->values->where('fields.key', 'first_name')->value('value'));
        $this->assertNotNull(auth()->user()?->values->where('fields.key', 'last_name')->value('value'));

        if (auth()->user()->desiredBeginning?->course_start_date <  Carbon::now()->subYears(ANONYMOUS_USER_YEARS)) {
            MakeAnonymousUser::make(User::latest()->first())->execute();
        }

        auth()->user()->refresh();

        $this->assertNull(auth()->user()?->first_name);
        $this->assertNull(auth()->user()?->last_name);
        $this->assertNull(auth()->user()->values->where('fields.key', 'first_name')->value('value'));
        $this->assertNull(auth()->user()->values->where('fields.key', 'last_name')->value('value'));
        $this->assertNull(auth()->user()->values->where('fields.key', 'date_of_birth')->value('value'));
    }

    /** @test */
    public function applicant_information_not_nullable_before_two_years()
    {
        $this->userCreatedProcess('2022-10-01');

        $this->assertNotNull(auth()->user()->first_name);
        $this->assertNotNull(auth()->user()->last_name);

        $this->assertNotNull(auth()->user()->values->where('fields.key', 'first_name')->value('value'));
        $this->assertNotNull(auth()->user()->values->where('fields.key', 'last_name')->value('value'));

        if (auth()->user()->desiredBeginning?->course_start_date <  Carbon::now()->subYears(ANONYMOUS_USER_YEARS)) {
            MakeAnonymousUser::make(auth()->user())->execute();
        }

        auth()->user()->refresh();

        $this->assertNotNull(auth()->user()->first_name);
        $this->assertNotNull(auth()->user()->last_name);
        $this->assertNotNull(auth()->user()->values->where('fields.key', 'first_name')->value('value'));
        $this->assertNotNull(auth()->user()->values->where('fields.key', 'last_name')->value('value'));
        $this->assertNotNull(auth()->user()->values->where('fields.key', 'date_of_birth')->value('value'));
    }

    private function userCreatedProcess($desiredBeginning)
    {
        $this->seed();

        $user = User::factory()->create([
            'first_name' => 'Applicant',
            'last_name' => 'User',
            'email' => 'applicant@example.com',
            'application_status' => ApplicationStatus::REGISTRATION_SUBMITTED,
        ]);

        $user->assignRole('applicant');
        $user->attachCourseWithDesiredBeginning($desiredBeginning, (Course::inRandomOrder()->take(2)->get()->pluck('id'))->toArray());

        $syncUser = new SyncUserValue($user);
        $syncUser();

        $dateOfBirthId = Field::where('key', 'date_of_birth')->value('id');
        FieldValue::updateOrCreate([
            'user_id' => $user->id,
            'field_id' => $dateOfBirthId,
        ], [
            'value' => '2020-01-01',
        ]);

        $this->actingAs($user);
    }
}
