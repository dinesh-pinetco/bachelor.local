<?php

namespace App\Services\SelectionTests;

use App\Imports\ResultImport;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class Cubia
{
    const MIX = '1';

    const IQT = '2';

    public null|User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function generateTestUrl($test = self::MIX, $wantToReset = false): string
    {
        $test = self::MIX == $test ? 'MIX' : 'IQT';
        $testUrl = '';

        if ($this->user->cubia_id) {
            $wantToReset = $wantToReset ? '&Reset' : '';
            $testUrl = config('services.cubia.base_url').'&UserID='.$this->user->cubia_id.'&Test='.$test.$wantToReset;
        }

        return $testUrl;
    }

    public function fetchResult(): void
    {
        try {
            // $fileName = 'result-1679999087.csv';
           $fileName = 'result-'.time().'.csv';
           $url = 'https://secure.cubia.de/oasys/nordakademie/NA-'.Carbon::now()->format('m-Y').'.txt';
           Storage::put($fileName, file_get_contents($url));

            Excel::import(new ResultImport(), $fileName);
           Storage::delete($fileName);
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
