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

class AreaPreparationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = FacadesDB::table('area_preparation')->select(
            'kav',
            'bagian',
            'area_store',
            'material',
            'warna',
            'qty_board',
            'publish',
            'total_qty',
            'plank',
            'month',
            'year',
            'factory',
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'Kav',
            'Bagian',
            'Area Store',
            'Material',
            'Warna',
            'Qty Board',
            'Publish',
            'Total Qty',
            'Plank',
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
