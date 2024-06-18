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
    
        $dataToExport = DB::table('area_final')
            ->select(
                'area_final.month',
                'area_final.kav',
                'area_final.bagian',
                'area_final.material',
                DB::raw("CASE WHEN area_final.total_qty IN ('#N/A', '#VALUE!', '#REF!') THEN 'N/A' ELSE area_final.total_qty END as total_qty"),
                'proses.wire_cost',
                'proses.component_cost',
                'proses.material_cost',
                'proses.material_cost_amount',
                'proses.process_cost',
                'proses.process_cost_amount',
                'proses.total_amount'
            )
            ->join('proses', 'area_final.id', '=', 'proses.area_final_id')
            ->where('proses.user_id', $user)
            ->unionAll(DB::table('area_preparation')
                ->select(
                    'area_preparation.month',
                    'area_preparation.kav',
                    'area_preparation.bagian',
                    'area_preparation.material',
                    DB::raw("CASE WHEN area_preparation.total_qty IN ('#N/A', '#VALUE!', '#REF!') THEN 'N/A' ELSE area_preparation.total_qty END as total_qty"),
                    'proses_pa.wire_cost',
                    'proses_pa.component_cost',
                    'proses_pa.material_cost',
                    'proses_pa.material_cost_amount',
                    'proses_pa.process_cost',
                    'proses_pa.process_cost_amount',
                    'proses_pa.total_amount')
                ->join('proses_pa', 'area_preparation.id', '=', 'proses_pa.area_preparation_id')
                ->where('proses_pa.user_id', $user))
            ->get();
    
        return Excel::download(new ReportExport($dataToExport), 'Report Amount.xlsx');
    }
    
    public function export_cv()
    {
        $user = Auth::id();
        set_time_limit(0);
    
        $conveyorsFromProses = Proses::select('area_final.bagian', 'proses.model_ukuran_warna', 'proses.specific_component_number')
            ->join('area_final', 'proses.area_final_id', '=', 'area_final.id')
            ->where('proses.user_id', $user)
            ->distinct()
            ->get();
    
        $conveyorsFromProsesPa = Proses_PA::select('area_preparation.bagian', 'proses_pa.model_ukuran_warna', 'proses_pa.specific_component_number')
            ->join('area_preparation', 'proses_pa.area_preparation_id', '=', 'area_preparation.id')
            ->where('proses_pa.user_id', $user)
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
