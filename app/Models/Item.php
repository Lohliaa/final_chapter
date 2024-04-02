<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = "item";
    protected $primaryKey = 'id';
    protected $fillable = [
        'component_number',
        'specific_component_number', 
        'component_name', 
        'user_id',
    ];

}
