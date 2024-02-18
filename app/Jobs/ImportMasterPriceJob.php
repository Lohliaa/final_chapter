<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\MasterPriceImport;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportMasterPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nama_file;

    /**
     * Create a new job instance.
     *
     * @param string $nama_file
     * @return void
     */
    public function __construct($nama_file)
    {
        $this->nama_file = $nama_file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nama_file = $this->nama_file;

        $path = 'public/excel/' . $nama_file;

        $import = Excel::import(new MasterPriceImport(), storage_path('app/public/excel/' . $nama_file));
        Storage::delete($path);
    }
}
