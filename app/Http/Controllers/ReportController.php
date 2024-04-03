<?php

namespace App\Http\Controllers;

use App\Exports\ReportCVExport;
use App\Models\Proses;
use App\Exports\ReportExport;
use App\Exports\ReportQTYExport;
use App\Models\Proses_PA;
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
                'kav',
                'bagian',
                'material',
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
            ->unionAll(DB::table('proses_pa')
                ->select(
                    'month',
                    'kav',
                    'bagian',
                    'material',
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
        return Excel::download(new ReportExport($dataToExport), 'Report Amount.xlsx');
    }
    
    public function export_cv()
    {
        $user = Auth::id();
        set_time_limit(0);

        $conveyorsFromProses = Proses::select('bagian', 'model_ukuran_warna', 'specific_component_number')
            ->where('user_id', $user)
            ->distinct()
            ->get();

        $conveyorsFromProsesPa = Proses_PA::select('bagian', 'model_ukuran_warna', 'specific_component_number')
            ->where('user_id', $user)
            ->distinct()
            ->get();

        $allConveyors = $conveyorsFromProses->concat($conveyorsFromProsesPa);

        $groupedConveyors = $allConveyors->groupBy('bagian');

        $conveyorSheets = [];

        foreach ($groupedConveyors as $conveyorType => $conveyorData) {
            $conveyorSheets[$conveyorType] = $conveyorData;
        }

        $exportSheets = new ReportCVExport($conveyorSheets);

        return Excel::download($exportSheets, 'Report Perbagian.xlsx');
    }

    public function export_qty()
    {
        set_time_limit(0);

        $useProsesPa = true;

        $reportExport = new ReportQTYExport($useProsesPa);

        $fileName = 'Report All.xlsx';

        return Excel::download($reportExport, $fileName);
    }
}
