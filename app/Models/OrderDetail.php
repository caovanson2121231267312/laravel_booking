<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        // 'user_id',
        'name_customer',
        'phone_customer',
        'customer_type_id',
        'price_person',
        'note'


    ];
}
