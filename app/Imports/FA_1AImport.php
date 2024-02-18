<?php

namespace App\Imports;

use App\Models\Fa_1A;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FA_1AImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Fa_1A([
            "car_line" => $row['carline'],
            "conveyor" => $row['conveyor'],
            "addressing_store" => $row['addressing_store'],
            "ctrl_no" => $row['ctrl_no'],
            "colour" => $row['colour'],
            "qty_kbn" => $row['qty_kbn'],
            "issue" => $row['issue'],
            "total_qty" => $row['total_qty'],
            "housing" => $row['housing'],
            "month" => $row['month'],
            "year" => $row['year'],
            "sai" => $row['sai'],
            "user_id" => $userRole,
        ]);

        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
