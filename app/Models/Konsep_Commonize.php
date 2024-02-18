<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsep_Commonize extends Model
{
    use HasFactory;

    protected $table = "konsep_commonize";
    protected $primaryKey = 'id';
    protected $fillable = [
        'ctrl_no', 
        'kind_new', 
        'size_new', 
        'col_new',
        'cl_28', 
        'term_b_new', 
        'acc_b1_new', 
        'acc_b2',
        'tube_b_new', 
        'term_a_new', 
        'acc_a1_new', 
        'acc_a2',
        'tube_a_new', 
        'user_id',
    ];

    public function proses()
    {
        return $this->belongsTo(Proses::class, 'ctrl_no', 'ctrl_no');
    }
}
