<?php

namespace App\Imports;

use App\Models\Area_Final;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AreaFinalImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Area_Final([
            "kav" => $row['kav'],
            "bagian" => $row['bagian'],
            "area_store" => $row['area_store'],
            "material" => $row['material'],
            "warna" => $row['warna'],
            "qty_board" => $row['qty_board'],
            "publish" => $row['publish'],
            "total_qty" => $row['total_qty'],
            "plank" => $row['plank'],
            "month" => $row['month'],
            "year" => $row['year'],
            "factory" => $row['factory'],
            "user_id" => $userRole,
        ]);

        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
