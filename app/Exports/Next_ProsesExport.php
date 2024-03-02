<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class Next_ProsesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = DB::table('next_proses')->select(
            'carline',
            'type',
            'jenis',
            'ctrl_no',
            'jenis_ctrl_no',
            'ctrl_no_cct',
            'kind',
            'size',
            'color',
            'kind_size_color',
            'cust_part_no',
            'cl',
            'term_b',
            'accb1',
            'accb2',
            'tubeb',
            'term_a',
            'acca1',
            'acca2',
            'tubea',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'Line',
            'Tipe',
            'Jenis',
            'Material',
            'Jenis Material',
            'Material Properties',
            'Model',
            'Ukuran',
            'Warna',
            'Model Ukuran Warna',
            'Specific Part Numb',
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
