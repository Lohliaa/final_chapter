<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $fillable = ["no_telp", "profile_foto", "user_id"];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    use HasFactory;
}