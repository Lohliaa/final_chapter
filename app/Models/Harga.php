<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = "harga";
    protected $primaryKey = 'id';
    protected $fillable = [
        'component_number_ori',
        'component_number', 
        'item', 
        'price_per_pcs', 
        'user_id',
    ];
}
