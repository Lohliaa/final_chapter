<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesMaterial extends Model
{
    use HasFactory;
    protected $table = "proses_material";
    protected $primaryKey = 'id';
    protected $fillable = [
        'length',
        'konversi',
        'qty_after_konversi',
        'cek',
        'price',
        'amount',
        'user_id'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    
}
