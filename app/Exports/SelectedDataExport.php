<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SelectedDataExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'no',
            'addressing_store',
            'ctrl_no',
            'ctrlno',
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
            'total_qty',
            'car_line',
            'wire_cost',
            'component_cost',
            'material_cost',
            'process',
            'umh',
            'charge',
            'process_cost',
            'total_cost',
            'total_amount'
        ];
    }

    public function map($row): array
    {
        return [
            $row->no,
            $row->addressing_store,
            $row->ctrl_no,
            $row->ctrlno,
            $row->kind,
            $row->size,
            $row->color,
            $row->kind_size_color,
            $row->cust_part_no,
            $row->cl,
            $row->term_b,
            $row->accb1,
            $row->accb2,
            $row->tubeb,
            $row->term_a,
            $row->acca1,
            $row->acca2,
            $row->tubea,
            $row->total_qty,
            $row->car_line,
            $row->wire_cost,
            $row->component_cost,
            $row->material_cost,
            $row->process,
            $row->umh,
            $row->charge,
            $row->process_cost,
            $row->total_cost,
            $row->total_amount
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}