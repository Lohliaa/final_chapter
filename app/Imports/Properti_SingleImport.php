<?php

namespace App\Imports;

use App\Models\Properti_Single;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class Properti_SingleImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation
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

        return new Properti_Single([
            "material_properties" => $row['material_properties'],
            "model" => $row['model'],
            "ukuran"  => $row['ukuran'],
            "warna" => $row['warna'],
            "cl" => $row['cl'],
            "trm_b" => $row['trm_b'],
            "acc_bag_b1" => $row['acc_bag_b1'],
            "acc_bag_b2" => $row['acc_bag_b2'],
            "tbe_b" => $row['tbe_b'],
            "trm_a" => $row['trm_a'],
            "acc_bag_a1" => $row['acc_bag_a1'],
            "acc_bag_a2" => $row['acc_bag_a2'],
            "tbe_a" => $row['tbe_a'],
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
