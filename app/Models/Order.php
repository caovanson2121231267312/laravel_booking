<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory ;
    protected $fillable = [
        'start',
        'end',
        'price',
        'total_price',
        'time',
        'traffic_id',
        'status_car',
        'status_payment'
    ];

    public function traffic()
    {
        return $this->belongsTo(traffic::class);
    }


    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
