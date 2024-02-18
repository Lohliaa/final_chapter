<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPrice extends Model
{
    use HasFactory;
    
    protected $table = "master_price";
    protected $primaryKey = 'id';
    protected $fillable = [
        'part_number_ori_sto',
        'part_number_mpl', 
        'buppin', 
        'price_per_pcs', 
        'user_id',
    ];
}