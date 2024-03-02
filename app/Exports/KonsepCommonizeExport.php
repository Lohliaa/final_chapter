<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class KonsepCommonizeExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();

        $type = DB::table('konsep_commonize')->select(
            'ctrl_no',
            'kind_new',
            'size_new',
            'col_new',
            'cl_28',
            'term_b_new',
            'acc_b1_new',
            'acc_b2',
            'tube_b_new',
            'term_a_new',
            'acc_a1_new',
            'acc_a2',
            'tube_a_new',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'Material Properties',
            'Model',
            'Ukuran',
            'Warna',
            'CL',
            'Terminal B',
            'Acc bag b1',
            'Acc bag b2',
            'Tube B',
            'Terminal A',
            'Acc bag a1',
            'Acc bag a2',
            'Tube A',
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
