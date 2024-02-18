<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Next_Proses extends Model
{
    use HasFactory;
    protected $table = "next_proses";
    protected $primaryKey = 'id';
    protected $fillable = [
        'carline',
        'type', 
        'jenis', 
        'ctrl_no', 
        'jenis_ctrl_no', 
        'ctrl_no_cct', 
        'kind', 
        'size', 
        'color',
        'kind_size_color',
        'cust_part_no',
        'cl',
        'term_b', 
        'accb1', 
        'accb2', 
        'tubeb',
        'term_a', 
        'acca1', 
        'acca2', 
        'tubea',
        'user_id',
    ];

    public function proses()
    {
        return $this->belongsTo(Proses::class, 'ctrl_no', 'ctrl_no');
    }    
}
