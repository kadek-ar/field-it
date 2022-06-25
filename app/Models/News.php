<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    // Field Status
    // 1 = Wait For Approve
    // 2 = Approve / Open
    // 3 = Close

    protected $guarded = [
        'id'
    ];
}
