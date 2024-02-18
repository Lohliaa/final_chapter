<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_List extends Model
{
    use HasFactory;
    protected $table = "item_list";
    protected $primaryKey = 'id';
    protected $fillable = [
        'part_no',
        'cust_pno', 
        'part_name', 
        'user_id',
    ];
}
