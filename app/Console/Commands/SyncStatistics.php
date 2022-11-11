<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Services\DesiredBeginningFilter;
use App\Services\ExportStatistics;
use Illuminate\Console\Command;

class SyncStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the every month statistics data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): bool|int
    {
        Course::get()->each(function ($course) {
            $desiredBeginnings = (new DesiredBeginningFilter($course))->filter(true);
            foreach ($desiredBeginnings as $key => $desiredBeginning) {
                $latestStatistics = (new ExportStatistics($desiredBeginning->date));
                $statisticsData = [
                    'total_applicants' => 0,
                    'checked_competency_catch_up' => 0,
                    'rejected_applicants' => 0,
                    'incomplete_applications' => 0,
                    'submitted_applications' => 0,
                    'rejected_applications_before_submitted_stage' => 0,
                    'approved_applications' => 0,
                    'rejected_applications_before_approved_stage' => 0,
                    'test_completed' => 0,
                    'rejected_applications_before_test_stage' => 0,
                    'completed_interviews' => 0,
                    'rejected_applications_before_interview_stage' => 0,
                    'contract_sent' => 0,
                    'rejected_applications_before_contract_sent' => 0,
                    'contract_return' => 0,
                    'rejected_applications_before_contract_return' => 0,
                    'application_enroll' => 0,
                ];

                foreach ($statisticsData as $key => &$value) {
                    $statisticsData[$key] = $latestStatistics->getApplicantsByFilter(snakeCaseToCamelCase($key),
                        'count', $course->id);
                }

                $statisticsData['desired_beginning_date'] = $desiredBeginning->date;

                $course->statistics()->create($statisticsData);
            }
        });

        return true;
    }
}
