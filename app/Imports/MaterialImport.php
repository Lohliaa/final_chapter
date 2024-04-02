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
            "code" => $row['code'],
            "area" => $row['area'],
            "hole" => $row['hole'],
            "component_number" => $row['component_number'],
            "component_name" => $row['component_name'],
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
