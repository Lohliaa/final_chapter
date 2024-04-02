<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ItemImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Item([
            "component_number" => $row['component_number'],
            "specific_component_number" => $row['specific_component_number'],
            "component_name" => $row['component_name'],
            "user_id" => $userRole,
        ]);

        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
