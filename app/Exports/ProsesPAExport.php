<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProsesPAExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
                    'kav' => $data->kav,
                    'bagian' => $data->bagian,
                    'area_store' => $data->area_store,
                    'material' => $data->material,
                    'material_properties' => $data->material_properties,
                    'model' => $data->model,
                    'ukuran' => $data->ukuran,
                    'warna' => $data->warna,
                    'model_ukuran_warna' => $data->model_ukuran_warna,
                    'specific_component_number' => $data->specific_component_number,
                    'cl' => $data->cl,
                    'trm_b' => $data->trm_b,
                    'acc_bag_b1' => $data->acc_bag_b1,
                    'acc_bag_b2' => $data->acc_bag_b2,
                    'tbe_b' => $data->tbe_b,
                    'trm_a' => $data->trm_a,
                    'acc_bag_a1' => $data->acc_bag_a1,
                    'acc_bag_a2' => $data->acc_bag_a2,
                    'tbe_a' => $data->tbe_a,
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
                    'process_cost_amount' => $data->process_cost_amount,
                    'total_amount' => $data->total_amount,
                    'keterangan' => $data->keterangan,
                ];
            });
    }


    public function headings(): array
    {
        return [
            'Month',
            'Kav',
            'Bagian',
            'Area Store',
            'Material',
            'Material Properties',
            'Model',
            'Ukuran',
            'Warna',
            'Model Ukuran Warna',
            'Specific Component Number',
            'CL',
            'TRM B',
            'Acc bag b1',
            'Acc bag b2',
            'TBE B',
            'TRM A',
            'Acc bag a1',
            'Acc bag a2',
            'TBE A',
            'Total Qty',
            'Harga',
            'Wire Cost',
            'Component Cost',
            'Material Cost',
            'Material Cost Amount',
            'Process',
            'UMH',
            'Charge',
            'Process Cost',
            'Process Cost Amount',
            'Total Cost Amount',
            'Keterangan'
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
