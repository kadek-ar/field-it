<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function fieldTypes(){
        return $this->belongsTo(FieldType::class, 'field_types_id');
    }

}
