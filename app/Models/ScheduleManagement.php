<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleManagement extends Model
{
    use HasFactory;

    protected $table = 'schedule_managements';

    // Status
    // 1 = Active
    // 2 = Close

    protected $guarded = [
        'id'
    ];

}
