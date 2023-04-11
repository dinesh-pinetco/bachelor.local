<?php

namespace App\Traits\User;

use App\Models\UserConfiguration;
use App\Pdf\ManagementSheetPdf as PdfManagementSheetPdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ManagementSheetPdf
{
    public function saveManagementSheetPdf()
    {
        $pdfPath = sprintf('contract-pdf/%s.pdf', Str::snake($this->id.' '.__('administration sheet') .$this->full_name));

        UserConfiguration::updateOrCreate(['user_id' => $this->id], [
            'contract_pdf_path' => $pdfPath,
            'contract_pdf_created_at' => now(),
        ]);

        Storage::put($pdfPath, (new PdfManagementSheetPdf($this))->download());
    }
}
