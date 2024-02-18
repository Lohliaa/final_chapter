<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class ItemListExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();

        $type = DB::table('item_list')->select(
            'part_no',
            'cust_pno',
            'part_name',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'part_no',
            'cust_pno',
            'part_name',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
