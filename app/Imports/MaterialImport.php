<?php

namespace App\Imports;

use App\Models\Fa_1C;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaterialImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Material([
            "factory" => $row['factory'],
            "carcode" => $row['carcode'],
            "area" => $row['area'],
            "cavity" => $row['cavity'],
            "partnumber" => $row['partnumber'],
            "part_name" => $row['part_name'],
            "qty_total" => $row['qty_total'],
            "user_id" => $userRole,
        ]);

        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
