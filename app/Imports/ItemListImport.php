<?php

namespace App\Imports;

use App\Models\Item_List;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ItemListImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Item_List([
            "part_no" => $row['part_no'],
            "cust_pno" => $row['cust_pno'],
            "part_name" => $row['part_name'],
            "user_id" => $userRole,
        ]);

        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
