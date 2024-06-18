<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_Preparation extends Model
{
    use HasFactory;

    protected $table = "area_preparation";
    protected $primaryKey = 'id';
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

    public function proses_pa()
    {
        return $this->hasMany(Proses_PA::class, 'area_preparation_id');
    }
}
