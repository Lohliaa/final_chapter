<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesFa_1A extends Model
{
    use HasFactory;

    protected $table = "proses_fa_1a";
    protected $primaryKey = 'id';
    protected $fillable = [
        'addressing_store',
        'ctrl_no',
        'ctrlno',
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
        'total_qty',
        'car_line',
        'price_sum',
        'wire_cost',
        'component_cost',
        'material_cost',
        'process',
        'umh',
        'charge',
        'process_cost',
        'total_cost',
        'total_amount',
        'keterangan',
        'user_id',
    ];

    public function fa_1a()
    {
        return $this->belongsTo(Fa_1C::class, 'ctrl_no', 'ctrl_no');
    }

    public function next_proses()
    {
        return $this->hasOne(Next_Proses::class, 'ctrl_no', 'ctrl_no');
    }

    public function konsep_commonize()
    {
        return $this->hasOne(Konsep_Commonize::class, 'ctrl_no', 'ctrl_no');
    }

    public function item_list()
    {
        return $this->hasOne(Item_List::class, 'part_no', 'kind_size_color');
    }
}
