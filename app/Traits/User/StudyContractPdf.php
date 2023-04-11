<?php

namespace App\Traits\User;

use App\Models\UserConfiguration;
use App\Pdf\StudyContractPdf as PdfStudyContractPdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StudyContractPdf
{
    public function saveStudyContractPdf()
    {
        $pdfPath = sprintf('study-contract-pdf/%s.pdf', Str::snake($this->id. ' '.__('study contract').$this->full_name));

        UserConfiguration::updateOrCreate(['user_id' => $this->id], [
            'study_contract_pdf_path' => $pdfPath,
            'study_contract_pdf_created_at' => now(),
        ]);

        Storage::put($pdfPath, (new PdfStudyContractPdf($this))->download());
    }
}
