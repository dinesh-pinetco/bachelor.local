<?php

namespace App\Imports;

use App\Models\Result;
use App\Models\Test;
use App\Services\SelectionTests\Cubia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CubiaResultImport implements ToModel, WithCustomCsvSettings
{
    protected $delimiter;

    public function model(array $row)
    {
        $row = array_values(array_filter($row));
        $index = count($row) - 2;
        $cubiaUserId = data_get($row, $index);
        $testType = data_get($row, 2);

        $result = Result::where('status', Result::STATUS_STARTED)
            ->whereRelation('user', 'cubia_id', $cubiaUserId)
            ->whereHas('test', function ($q) use ($testType) {
                $q->where('type', Test::TYPE_CUBIA)
                    ->where('course_id', $testType == Cubia::MIX ? Cubia::MIX : Cubia::IQT);
            })
            ->first();

        if ($result) {
            $result->updateTestResult(data_get($row, 2), end($row), json_encode($row));
        }
    }

    public function setDelimiter(string $delimiter): self
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter' => ';',
        ];
    }
}
