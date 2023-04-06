<?php

namespace Tests\Unit;

use App\Models\DesiredBeginning;
use Carbon\Carbon;
use Tests\TestCase;

class DesiredBeginningTest extends TestCase
{
    /** @test */
    public function application_only_for_current_year()
    {
        $desiredBeginnings = DesiredBeginning::options();

        $expect = [[
            'key' => now()->year.'-10-01',
            'title' => 'Oktober '.now()->year,
        ]];

        $this->assertCount(1, $desiredBeginnings);
        $this->assertSame($expect, $desiredBeginnings);
    }

    /** @test */
    public function application_for_current_and_next_year()
    {
        Carbon::setTestNow(Carbon::create(2023, 6, 1));

        $desiredBeginnings = DesiredBeginning::options();

        $expect = [
            [
                'key' => '2023-10-01',
                'title' => 'Oktober 2023',
            ],
            [
                'key' => '2024-10-01',
                'title' => 'Oktober 2024',
            ],
        ];

        $this->assertCount(2, $desiredBeginnings);
        $this->assertSame($expect, $desiredBeginnings);
    }
}
