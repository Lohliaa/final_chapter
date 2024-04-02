<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseKonversi extends Model
{
    use HasFactory;
    
    protected $table = "database_konversi";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nomor_komponen',
        'item', 
        'nama_komponen', 
        'satuan', 
        'inner_packing',
        'user_id',
    ];
}
