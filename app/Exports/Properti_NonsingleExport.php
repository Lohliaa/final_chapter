<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;

class Properti_NonsingleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $user = Auth::id();
        $type = DB::table('properti_nonsingle')->select(
            'kav',
            'tipe', 
            'jenis', 
            'material', 
            'jenis_material', 
            'material_properties', 
            'model', 
            'ukuran', 
            'warna',
            'model_ukuran_warna',
            'no_item',
            'cl',
            'trm_b', 
            'acc_bag_b1', 
            'acc_bag_b2', 
            'tbe_b',
            'trm_b', 
            'acc_bag_a1', 
            'acc_bag_b2', 
            'tbe_a',
    
        )
        ->where('user_id', $user)
        ->get();
        return $type;
    }
    public function headings(): array
    {
        return [
            'kav',
            'tipe', 
            'jenis', 
            'material', 
            'jenis_material', 
            'material_properties', 
            'model', 
            'ukuran', 
            'warna',
            'model_ukuran_warna',
            'no_item',
            'cl',
            'trm_b', 
            'acc_bag_b1', 
            'acc_bag_b2', 
            'tbe_b',
            'trm_b', 
            'acc_bag_a1', 
            'acc_bag_b2', 
            'tbe_a',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
