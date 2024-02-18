<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class MaterialExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = DB::table('material')->select(
            'factory',
            'carcode',
            'area',
            'cavity',
            'partnumber',
            'part_name',
            'qty_total'
        )
            ->where('user_id', $user)
            ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'factory',
            'carcode',
            'area',
            'cavity',
            'partnumber',
            'part_name',
            'qty_total'
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
