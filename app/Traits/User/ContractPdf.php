<?php

namespace App\Traits\User;

use App\Models\UserConfiguration;
use App\Pdf\ManagementSheetPdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ContractPdf
{
    public function saveContractPdf()
    {
        $pdfPath = sprintf('contract-pdf/%s.pdf', Str::kebab(class_basename($this->id.' '.$this->full_name.' contract')));

        UserConfiguration::updateOrCreate(['user_id' => $this->id], [
            'contract_pdf_path' => $pdfPath,
            'contract_pdf_created_at' => now(),
        ]);

        Storage::put($pdfPath, (new ManagementSheetPdf($this))->download());
    }
}
