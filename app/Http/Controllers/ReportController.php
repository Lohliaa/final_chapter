<?php

namespace App\Http\Controllers;

use App\Exports\ConveyorSheet;
use App\Exports\ConveyorSheetExport;
use App\Exports\ReportCVExport;
use App\Models\Proses;
use App\Exports\ReportExport;
use App\Exports\ReportQTYExport;
use App\Models\ProsesFa_1A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function index()
    {
        set_time_limit(0);
        return view('report.index');
    }

    public function export()
    {
        $user = Auth::id();
        set_time_limit(0);

        $dataToExport = DB::table('proses')
            ->select(
                'month',
                'car_line',
                'conveyor',
                'ctrl_no',
                DB::raw("CASE WHEN total_qty IN ('#N/A', '#VALUE!', '#REF!') THEN 'N/A' ELSE total_qty END as total_qty"),                'wire_cost',
                'component_cost',
                'material_cost',
                'material_cost_amount',
                'process_cost',
                // 'total_cost',
                'process_cost_amount',
                'total_amount'
            )
            ->where('user_id', $user)
            ->unionAll(DB::table('proses_fa_1a')
                ->select(
                    'month',
                    'car_line',
                    'conveyor',
                    'ctrl_no',
                    DB::raw("CASE WHEN total_qty IN ('#N/A', '#VALUE!', '#REF!') THEN 'N/A' ELSE total_qty END as total_qty"),                    'wire_cost',
                    'component_cost',
                    'material_cost',
                    'material_cost_amount',
                    'process_cost',
                    // 'total_cost',
                    'process_cost_amount',
                    'total_amount')
                ->where('user_id', $user))
            ->get();
        return Excel::download(new ReportExport($dataToExport), 'Hasil STO.xlsx');
    }
    
    public function export_cv()
    {
        $user = Auth::id();
        set_time_limit(0);

        $conveyorsFromProses = Proses::select('conveyor', 'kind_size_color', 'cust_part_no')
            ->where('user_id', $user)
            ->distinct()
            ->get();

        $conveyorsFromProsesFa1A = ProsesFa_1A::select('conveyor', 'kind_size_color', 'cust_part_no')
            ->where('user_id', $user)
            ->distinct()
            ->get();

        $allConveyors = $conveyorsFromProses->concat($conveyorsFromProsesFa1A);

        $groupedConveyors = $allConveyors->groupBy('conveyor');

        $conveyorSheets = [];

        foreach ($groupedConveyors as $conveyorType => $conveyorData) {
            $conveyorSheets[$conveyorType] = $conveyorData;
        }

        $exportSheets = new ReportCVExport($conveyorSheets);

        return Excel::download($exportSheets, 'report_cv.xlsx');
    }

    public function export_qty()
    {
        set_time_limit(0);

        $useProsesFa1a = true;

        $reportExport = new ReportQTYExport($useProsesFa1a);

        $fileName = 'report_all.xlsx';

        return Excel::download($reportExport, $fileName);
    }
}
