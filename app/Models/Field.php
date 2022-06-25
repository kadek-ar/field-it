<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';

    // Field Status
    // 1 = Wait For Approve
    // 2 = Approve / Open
    // 3 = Close

    protected $guarded = [
        'id'
    ];

    // public function schdules(){
    //     return $this->hasMany('App\Schedule', 'field_id', 'id');
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
