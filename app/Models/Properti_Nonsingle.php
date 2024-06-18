<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti_Nonsingle extends Model
{
    use HasFactory;
    protected $table = "properti_nonsingle";
    protected $primaryKey = 'id';
    protected $fillable = [
        'kav',
        'tipe', 
        'jenis', 
        'material', 
        'jenis_material', 
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
        'acc_bag_b2', 
        'tbe_a',
        'user_id',
    ];

}
