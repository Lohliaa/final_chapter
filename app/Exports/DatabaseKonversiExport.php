<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class DatabaseKonversiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = DB::table('database_konversi')->select(
            'part_no',
            'buppin', 
            'part_name', 
            'uom', 
            'inner_packing',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'part_no',
            'buppin', 
            'part_name', 
            'uom', 
            'inner_packing',
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
