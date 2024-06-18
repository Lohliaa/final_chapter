<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProsesMaterialExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMultipleSheets
{
    use Exportable;

    public function collection()
    {
        $user = Auth::id();
        $type = FacadesDB::table('proses_material')->select(
            'factory',
            'code',
            'area',
            'hole',
            'component_number',
            'component_name',
            'qty_total',
            'length',
            'konversi',
            'qty_after_konversi',
            'cek',
            'price',
            'amount'
        )
            ->where('user_id', $user)
            ->get();
        return $type;
    }

    public function headings(): array
    {
        return [
            'Factory',
            'Kav',
            'Area',
            'Hole',
            'Component Number',
            'Component Name',
            'Qty Total',
            'Length',
            'Konversi',
            'Qty After Konversi',
            'Cek',
            'Price',
            'Total'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function sheets(): array
    {
        $user = Auth::id();

        $sheets = [
            new ProsesMaterialSheet($user),
            new SummarySheet($user),
            new PartNumberSummarySheet($user),
            new PartNumberByCarcodeSummarySheet($user)
        ];

        return $sheets;
    }
}

class ProsesMaterialSheet implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    // mengambil data dari db
    public function collection()
    {
        $data = FacadesDB::table('material')
            ->join('proses_material', 'material.id', '=', 'proses_material.material_id')
            ->select(
                'material.factory',
                'material.code',
                'material.area',
                'material.hole',
                'material.component_number',
                'material.component_name',
                'material.qty_total',
                'proses_material.length',
                'proses_material.konversi',
                'proses_material.qty_after_konversi',
                'proses_material.cek',
                'proses_material.price',
                'proses_material.amount'
            )
            ->where('material.user_id', $this->userId)
            ->get();
    
        return $data;
    }
    
    public function headings(): array
    {
        return [
            'Factory',
            'Kav',
            'Area',
            'Hole',
            'Component Number',
            'Component Name',
            'Qty Total',
            'Length',
            'Konversi',
            'Qty After Konversi',
            'Cek',
            'Price',
            'Total'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}

class SummarySheet implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return FacadesDB::table('proses_material')
            ->select(
                'material.code',
                FacadesDB::raw('SUM(proses_material.qty_after_konversi) as total_qty_total'),
                FacadesDB::raw('SUM(proses_material.amount) as total_amount')
            )
            ->join('material', 'proses_material.material_id', '=', 'material.id')
            ->where('proses_material.user_id', $this->userId)
            ->groupBy('material.code')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kav',
            'Total Qty Total',
            'Total Amount'
        ];
    }
}

class PartNumberSummarySheet implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return FacadesDB::table('proses_material')
            ->select(
                'material.component_number',
                FacadesDB::raw('SUM(proses_material.qty_after_konversi) as total_qty_total')
            )
            ->join('material', 'proses_material.material_id', '=', 'material.id')
            ->where('proses_material.user_id', $this->userId)
            ->groupBy('material.component_number')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Component Number',
            'Total Qty Total'
        ];
    }
}

class PartNumberByCarcodeSummarySheet implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return FacadesDB::table('proses_material')
            ->select(
                'material.code',
                'material.component_number',
                FacadesDB::raw('SUM(proses_material.qty_after_konversi) as total_qty_total')
            )
            ->join('material', 'proses_material.material_id', '=', 'material.id')
            ->where('proses_material.user_id', $this->userId)
            ->groupBy('material.component_number', 'material.code')
            ->orderBy('material.code')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kav',
            'Component Number',
            'Total Qty Total'
        ];
    }
}
