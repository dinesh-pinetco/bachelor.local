<?php

namespace App\Imports;

use App\Models\Result;
use App\Models\Test;
use App\Services\SelectionTests\Cubia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ResultImport implements ToModel, WithCustomCsvSettings
{
    protected $delimiter;

    public function model(array $row)
    {
        $row = array_values(array_filter($row));
        $index = count($row) - 2;
        $cubiaUserId = data_get($row, $index);
        $result = Result::where('status', Result::STATUS_STARTED)
            ->whereRelation('user', 'cubia_id', $cubiaUserId)
            ->whereRelation('test', 'type', Test::TYPE_CUBIA)
            ->first();

        if ($result) {
            $counter = 0;
            foreach ($row as $key => $value) {
                //                TODO:Below Pass limit remove task provide by client. please check this task
                //                https://app.clickup.com/t/2zfvpva
                if ($key > 2 && $value >= 0 && $row[2] == Cubia::MIX && $key < count($row) - 2) {
                    $counter++;
                } elseif ($key > 2 && $value >= 0 && $row[2] == Cubia::IQT && $key < count($row) - 2) {
                    $counter++;
                }
            }

            $isPassed = ($counter == (count($row) - 5)) ? true : false;

            if ($result && $row[2] == Cubia::MIX) {
                $result->update(['is_passed_mix' => $isPassed, 'result' => $row[0].'-'.$row[1], 'result_mix_link' => end($row), 'meta_mix' => $row]);
            } elseif ($result && $row[2] == Cubia::IQT) {
                $result->update(['is_passed_iqt' => $isPassed, 'result' => $row[0].'-'.$row[1], 'result_iqt_link' => end($row), 'meta_iqt' => $row]);
            }

            if ($result && ! is_null($result->result_mix_link) && ! is_null($result->result_iqt_link)) {
                $isPassed = ($result->is_passed_mix == true && $result->is_passed_iqt == true) ? true : false;

                $result->update(['status' => Result::STATUS_COMPLETED, 'is_passed' => $isPassed]);

                $result->user->saveApplicationStatus();
            }
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
