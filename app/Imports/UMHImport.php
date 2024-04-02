<?php

namespace App\Imports;

use App\Models\C1;
use App\Models\UMH_Master;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UMHImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new UMH_Master([
            "kav" => $row['kav'],
            "code_umh1" => $row['code_10'],
            "code_umh2" => $row['code_20'],
            "code_umh3" => $row['code_30'],
            "kode_umh1" => $row['proses_10'],
            "kode_umh2" => $row['proses_20'],
            "kode_umh3" => $row['proses_30'],
            "charge" => $row['charge'],
            "user_id" => $userRole,
        ]);
        return null;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
