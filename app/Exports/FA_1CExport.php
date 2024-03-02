<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class FA_1CExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = DB::table('fa_1c')->select(
            'car_line',
            'conveyor',
            'addressing_store',
            'ctrl_no',
            'colour',
            'qty_kbn',
            'issue',
            'total_qty',
            'housing',
            'month',
            'year',
            'sai',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'Line',
            'Bagian',
            'Area Store',
            'Material',
            'Warna',
            'Qty Board',
            'Issue',
            'Total Qty',
            'Area',
            'Month',
            'Year',
            'Factory',
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
