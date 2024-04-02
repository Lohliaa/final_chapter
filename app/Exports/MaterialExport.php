<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class MaterialExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = FacadesDB::table('material')->select(
            'factory',
            'code',
            'area',
            'hole',
            'component_number',
            'component_name',
            'qty_total'
        )
            ->where('user_id', $user)
            ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'Factory',
            'Code',
            'Area',
            'Hole',
            'Component Number',
            'Component Name',
            'Qty Total'
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
