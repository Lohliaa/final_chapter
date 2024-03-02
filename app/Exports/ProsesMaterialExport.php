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
            'carcode',
            'area',
            'cavity',
            'partnumber',
            'part_name',
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
            'Code',
            'Area',
            'Cavity',
            'Part Number',
            'Part Name',
            'Qty Total',
            'Length',
            'Konversi',
            'Qty After Konversi',
            'Cek',
            'Harga',
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

    public function collection()
    {
        $data = FacadesDB::table('proses_material')
            ->select(
                'factory',
                'carcode',
                'area',
                'cavity',
                'partnumber',
                'part_name',
                'qty_total',
                'length',
                'konversi',
                'qty_after_konversi',
                'cek',
                'price',
                'amount'
            )
            ->where('user_id', $this->userId)
            ->get();

        // Manipulasi nilai cek menjadi 0 hanya jika nilainya 0
        $data = $data->map(function ($item) {
            if ($item->cek === 0) {
                $item->cek = 0;
            }
            return $item;
        });

        return $data;
    }


    public function headings(): array
    {
        return [
            'Factory',
            'Code',
            'Area',
            'Cavity',
            'Part Number',
            'Part Name',
            'Qty Total',
            'Length',
            'Konversi',
            'Qty After Konversi',
            'Cek',
            'Harga',
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
                'carcode',
                FacadesDB::raw('SUM(qty_after_konversi) as total_qty_total'),
                FacadesDB::raw('SUM(amount) as total_amount')
            )
            ->where('user_id', $this->userId)
            ->groupBy('carcode')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Code',
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
                'partnumber',
                FacadesDB::raw('SUM(qty_after_konversi) as total_qty_total')
            )
            ->where('user_id', $this->userId)
            ->groupBy('partnumber')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Part Number',
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
                'carcode',
                'partnumber',
                FacadesDB::raw('SUM(qty_after_konversi) as total_qty_total')
            )
            ->where('user_id', $this->userId)
            ->groupBy('partnumber', 'carcode')
            ->orderBy('carcode')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Code',
            'Part Number',
            'Total Qty Total'
        ];
    }
}
