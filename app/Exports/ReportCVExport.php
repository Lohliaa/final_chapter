<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\ConveyorSheetExport;
use App\Utilities\ExportUtilities;

class ReportCVExport implements WithMultipleSheets
{
    protected $conveyorSheets;

    public function __construct($conveyorSheets)
    {
        $this->conveyorSheets = $conveyorSheets;
    }
    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->conveyorSheets as $conveyorData) {
            $sheets[] = new ConveyorSheetExport($conveyorData);
        }

        return $sheets;
    }
}
