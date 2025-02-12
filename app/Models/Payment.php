<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',         
        'reference_number', 
        'evidence',         
        'status',           
        'amount',           
        'currency',         
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function getStatusAttribute($value)
    {
        return $value == 'successful' ? 'Successful' : 'Failed';
    }
}
