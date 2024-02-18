<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fa_1C extends Model
{
    use HasFactory;
    protected $table = "fa_1c";
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

    public function proses()
    {
        return $this->hasMany(Proses::class, 'ctrl_no', 'ctrl_no');
    }

    public function next_proses()
    {
        return $this->hasMany(NextProses::class, 'ctrl_no', 'ctrl_no');
    }

    public function konsep_commonize()
    {
        return $this->hasMany(CommonizeSto::class, 'ctrl_no', 'ctrl_no');
    }
}
