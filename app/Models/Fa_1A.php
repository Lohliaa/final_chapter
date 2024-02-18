<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fa_1A extends Model
{
    use HasFactory;
    protected $table = "fa_1a";
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'car_line',
        'conveyor',
        'addressing_store',
        'ctrl_no',
        'colour',
        'qty_kbn',
        'issue',
        'total_qty',
        'housing',
        'month',
        'year',
        'sai',
        'user_id',
    ];
    // Relasi dengan model Proses
    public function proses()
    {
        return $this->hasMany(Proses::class, 'ctrl_no', 'ctrl_no');
    }

    // Relasi dengan model NextProses
    public function next_proses()
    {
        return $this->hasMany(NextProses::class, 'ctrl_no', 'ctrl_no');
    }

    // Relasi dengan model CommonizeSto
    public function konsep_commonize()
    {
        return $this->hasMany(CommonizeSto::class, 'ctrl_no', 'ctrl_no');
    }
}
