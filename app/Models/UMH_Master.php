<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMH_Master extends Model
{
    use HasFactory;
    protected $table = "umh_master";
    protected $primaryKey = 'id';
    protected $fillable = [
        'car_line',
        'code_umh1', 
        'code_umh2', 
        'code_umh3',
        'kode_umh1', 
        'kode_umh2', 
        'kode_umh3',
        'charge',
        'user_id',
    ];

}
