<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProsesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $dataToExport;

    public function __construct(Collection $dataToExport)
    {
        $this->dataToExport = $dataToExport;
    }

    public function collection()
    {
        $user = Auth::id();

        return $this->dataToExport
            ->where('user_id', $user)
            ->map(function ($data) {
                return [
                    'month' => $data->month,
                    'car_line' => $data->car_line,
                    'conveyor' => $data->conveyor,
                    'addressing_store' => $data->addressing_store,
                    'ctrl_no' => $data->ctrl_no,
                    'ctrlno' => $data->ctrlno,
                    'kind' => $data->kind,
                    'size' => $data->size,
                    'color' => $data->color,
                    'kind_size_color' => $data->kind_size_color,
                    'cust_part_no' => $data->cust_part_no,
                    'cl' => $data->cl,
                    'term_b' => $data->term_b,
                    'accb1' => $data->accb1,
                    'accb2' => $data->accb2,
                    'tubeb' => $data->tubeb,
                    'term_a' => $data->term_a,
                    'acca1' => $data->acca1,
                    'acca2' => $data->acca2,
                    'tubea' => $data->tubea,
                    'total_qty' => $data->total_qty,
                    'price_sum' => $data->price_sum,
                    'wire_cost' => $data->wire_cost,
                    'component_cost' => $data->component_cost,
                    'material_cost' => $data->material_cost,
                    'material_cost_amount' => $data->material_cost_amount,
                    'process' => $data->process,
                    'umh' => $data->umh,
                    'charge' => $data->charge,
                    'process_cost' => $data->process_cost,
                    'process_cost_amount' =>  $data->process_cost_amount,
                    'total_amount' => $data->total_amount,
                    'keterangan' => $data->keterangan,

                ];
            });
    }

    public function headings(): array
    {
        return [
            'month',
            'car_line',
            'conveyor',
            'addressing_store',
            'ctrl_no',
            'ctrlno_database',
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
            'price',
            'wire_cost',
            'component_cost',
            'material_cost',
            'material_cost_amount',
            'process',
            'umh',
            'charge',
            'process_cost',
            'process_cost_amount',
            'total_cost_amount',
            'keterangan'
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
