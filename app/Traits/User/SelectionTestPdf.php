<?php

namespace App\Traits\User;

use App\Models\UserConfiguration;
use App\Pdf\SelectionTestFailedResultPdf;
use App\Pdf\SelectionTestPassedResultPdf;
use Illuminate\Support\Str;
use Storage;

trait SelectionTestPdf
{
    public function savePassedPdf()
    {
        $pdfPath = sprintf('test-results/%s.pdf', Str::kebab(class_basename($this->id.' '.$this->full_name.' passed result')));

        UserConfiguration::updateOrCreate(['user_id' => $this->id], [
            'selection_test_result_passed_pdf_path' => $pdfPath,
            'pass_pdf_created_at' => now(),
        ]);

        Storage::put($pdfPath, (new SelectionTestPassedResultPdf($this))->download());
    }

    public function saveFailedPdf()
    {
        $pdfPath = sprintf('test-results/%s.pdf', Str::kebab(class_basename($this->id.' '.$this->full_name.' failed result')));

        UserConfiguration::updateOrCreate(['user_id' => $this->id], [
            'selection_test_result_failed_pdf_path' => $pdfPath,
            'fail_pdf_created_at' => now(),
        ]);

        Storage::put($pdfPath, (new SelectionTestFailedResultPdf($this))->download());
    }
}