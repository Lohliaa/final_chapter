<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_Final extends Model
{
    use HasFactory;

    protected $table = "area_final";
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'kav',
        'bagian',
        'area_store',
        'material',
        'warna',
        'qty_board',
        'publish',
        'total_qty',
        'plank',
        'month',
        'year',
        'factory',
        'user_id',
    ];
}
