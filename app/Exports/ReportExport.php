<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithMultipleSheets, WithStyles, ShouldAutoSize
{
    protected $dataToExport;

    public function __construct($dataToExport)
    {
        $this->dataToExport = $dataToExport;
    }

    public function collection()
    {
        return $this->dataToExport;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            // Add more styles as needed
        ];
    }

    public function sheets(): array
    {
        $groupedData = $this->dataToExport->groupBy('conveyor');

        $sheets = [];

        $sheets[] = new FirstSheet($this->dataToExport); // Pass the raw data here

        $sheets[] = new SecondSheet($groupedData);

        return $sheets;
    }
}

class FirstSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $dataToExport;

    public function __construct(Collection $dataToExport)
    {
        $this->dataToExport = $dataToExport;
    }

    public function collection()
    {
        return $this->dataToExport;
    }

    public function title(): string
    {
        return 'Sheet 1';
    }

    public function headings(): array
    {
        return [
            'month',
            'car_line',
            'conveyor',
            'ctrl_no',
            'total_qty',
            'wire_cost',
            'component_cost',
            'material_cost',
            'material_cost_amount',
            'process_cost',
            // 'total_cost', 
            'process_cost_amount',
            'total_cost_amount',
                       
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            // Add more styles as needed for this sheet
        ];
    }
}

class SecondSheet implements FromCollection, WithTitle, WithStyles, ShouldAutoSize
{
    protected $groupedData;

    public function __construct($groupedData)
    {
        $this->groupedData = $groupedData;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->groupedData as $conveyor => $conveyorGroup) {
            $conveyorRow = [];

            $data[] = $conveyorRow;

            $processedCarLines = [];

            foreach ($conveyorGroup as $dataRow) {
                $carLine = $dataRow->car_line;

                if (!in_array($carLine, $processedCarLines)) {
                    $preAssaySums = $this->calculatePreAssaySums($conveyorGroup->where('car_line', $carLine));

                    $row = [
                        'Month' => $dataRow->month,
                        'Carline' => $carLine,
                        'Conveyor' => $dataRow->conveyor,
                        'Total Qty' => $preAssaySums['pre_assay_total_qty'],
                        'Total Cost Amount' => $preAssaySums['pre_assay_total_cost_amount'],                        
                    ];

                    $data[] = $row;

                    $processedCarLines[] = $carLine;
                }
            }
        }

        // Insert the heading row at the beginning
        array_unshift($data, [
            'Month',
            'Carline',
            'Conveyor',
            'Total Qty',
            'Total Cost Amount'
        ]);

        return collect($data);
    }

    public function title(): string
    {
        return 'Sheet 2';
    }
    public function styles(Worksheet $sheet)

    {

        return [

            1 => ['font' => ['bold' => true]],

        ];

    }
    protected function calculatePreAssaySums($group)
    {
        return [
            'pre_assay_total_qty' => $group->sum(function ($item) {
                if ($item->total_qty == '#N/A' || $item->total_qty == '#VALUE!') {
                    return $item->total_qty;
                } else {
                    return is_numeric($item->total_qty) ? $item->total_qty : 0;
                }
            }),
            'pre_assay_total_cost_amount' => $group->sum('total_amount'),
        ];
    }
}
