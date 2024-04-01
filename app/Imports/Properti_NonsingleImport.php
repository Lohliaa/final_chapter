<?php

namespace App\Imports;

use App\Models\Next_Proses;
use App\Models\Properti_Nonsingle;
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

class Properti_NonsingleImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation
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

        return new Properti_Nonsingle([
            "kav" => $row['kav'],
            "tipe" => $row['tipe'],
            "jenis" => $row['jenis'],
            "material" => $row['material'],
            "jenis_material" => $row['jenis_material'],
            "material_properties" => $row['material_properties'],
            "model" => $row['model'],
            "ukuran"  => $row['ukuran'],
            "warna" => $row['warna'],
            "model_ukuran_warna" => $row['model_ukuran_warna'],
            "no_item" => $row['no_item'],
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
