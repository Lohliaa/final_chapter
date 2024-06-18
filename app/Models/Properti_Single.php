<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti_Single extends Model
{
    use HasFactory;
    
    protected $table = "properti_single";
    protected $primaryKey = 'id';
    protected $fillable = [
        'material_properties', 
        'model', 
        'ukuran', 
        'warna',
        'cl', 
        'trm_b', 
        'acc_bag_b1', 
        'acc_bag_b2',
        'tbe_b', 
        'trm_a', 
        'acc_bag_a1', 
        'acc_bag_a2',
        'tbe_a', 
        'user_id',
    ];

}
