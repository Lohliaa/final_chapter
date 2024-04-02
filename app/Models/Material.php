<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = "material";
    protected $primaryKey = 'id';
    protected $fillable = [
    'factory',
    'code',
    'area',
    'hole',
    'component_number',
    'component_name',
    'qty_total',
    'user_id',
    ];

    public function proses_material()
    {
        return $this->hasMany(ProsesMaterial::class, 'partnumber', 'partnumber');
    }
}
