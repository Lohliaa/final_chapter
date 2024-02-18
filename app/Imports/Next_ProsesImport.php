<?php

namespace App\Imports;

use App\Models\Next_Proses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use League\Config\Exception\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class Next_ProsesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation
{
    protected $errors = [];

    public function rules(): array
    {
        return [
            'cl' => 'required|numeric',
        ];
    }

    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Next_Proses([
            "carline" => $row['carline'],
            "type" => $row['type'],
            "jenis" => $row['jenis'],
            "ctrl_no" => $row['ctrl_no'],
            "jenis_ctrl_no" => $row['jenis_ctrl_no'],
            "ctrl_no_cct" => $row['ctrl_no_cct'],
            "kind" => $row['kind'],
            "size"  => $row['size'],
            "color" => $row['color'],
            "kind_size_color" => $row['kind_size_color'],
            "cust_part_no" => $row['cust_part_no'],
            "cl" => $row['cl'],
            "term_b" => $row['term_b'],
            "accb1" => $row['accb1'],
            "accb2" => $row['accb2'],
            "tubeb" => $row['tubeb'],
            "term_a" => $row['term_a'],
            "acca1" => $row['acca1'],
            "acca2" => $row['acca2'],
            "tubea" => $row['tubea'],
            "user_id" => $userRole,
        ]);
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function onError(Throwable $e)
    {
        $this->errors[] = $e->getMessage();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
    public function withValidation($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                $this->errors[] = $validator->errors()->all();
            }
        });
    }
}
