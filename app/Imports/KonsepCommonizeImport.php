<?php

namespace App\Imports;

use App\Models\Konsep_Commonize;
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

class KonsepCommonizeImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation
{
    protected $errors = [];

    public function rules(): array
    {
        return [
            'cl_28' => 'required|numeric',
        ];
    }
    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Konsep_Commonize([
            "ctrl_no" => $row['ctrl_no'],
            "kind_new" => $row['kind_new'],
            "size_new" => $row['size_new'],
            "col_new" => $row['col_new'],
            "cl_28" => $row['cl_28'],
            "term_b_new" => $row['term_b_new'],
            "acc_b1_new" => $row['acc_b1_new'],
            "acc_b2" => $row['acc_b2'],
            "tube_b_new" => $row['tube_b_new'],
            "term_a_new" => $row['term_a_new'],
            "acc_a1_new" => $row['acc_a1_new'],
            "acc_a2" => $row['acc_a2'],
            "tube_a_new" => $row['tube_a_new'],
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
