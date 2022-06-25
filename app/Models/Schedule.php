<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Schedule Status
    // 1 = Available
    // 2 = Not Available
    // 3 = Close

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        "time"
    ];

    // public function fields(){
    //     return $this->belongsTo(Field::class);
    // }
}
