<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses_PA extends Model
{
    use HasFactory;

    protected $table = "proses_pa";
    protected $primaryKey = 'id';
    protected $fillable = [
        'area_store',
        'material',
        'material_properties',
        'model',
        'ukuran',
        'warna',
        'model_ukuran_warna',
        'no_item',
        'cl',
        'trm_b',
        'acc_bag_b1',
        'acc_bag_b2',
        'tbe_b',
        'trm_a',
        'acc_bag_a1',
        'acc_bag_a2',
        'tbe_b',
        'total_qty',
        'kav',
        'price_sum',
        'wire_cost',
        'component_cost',
        'material_cost',
        'process',
        'umh',
        'charge',
        'process_cost',
        'total_cost',
        'total_amount',
        'keterangan',
        'user_id',
    ];
}
