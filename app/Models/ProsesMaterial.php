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
        'factory',
        'code',
        'area',
        'hole',
        'component_number',
        'component_name',
        'qty_total',
        'length',
        'konversi',
        'qty_after_konversi',
        'cek',
        'price',
        'amount',
        'user_id',
    ];
    
    public function material()
    {
        return $this->belongsTo(Material::class, 'partnumber', 'partnumber');
    }
    public function konversi()
{
    return $this->belongsTo(DatabaseKonversi::class, 'part_no', 'part_no');
}

}
