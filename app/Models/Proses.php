<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    use HasFactory;

    protected $table = "proses";
    protected $primaryKey = 'id';
    protected $fillable = [
        'material_properties',
        'model',
        'ukuran',
        'warna',
        'model_ukuran_warna',
        'specific_component_number',
        'cl',
        'trm_b',
        'acc_bag_b1',
        'acc_bag_b2',
        'tbe_b',
        'trm_a',
        'acc_bag_a1',
        'acc_bag_a2',
        'tbe_a',
        'price_sum',
        'wire_cost',
        'component_cost',
        'material_cost',
        'material_cost_amount',
        'process',
        'umh',
        'charge',
        'process_cost',
        'total_cost',
        'total_amount',
        'keterangan',
        'user_id',
    ];

    public function area_final()
    {
        return $this->belongsTo(Area_Final::class);
    }

}
