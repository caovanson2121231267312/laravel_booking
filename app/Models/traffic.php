<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class traffic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_car',
        'note',
        'status',
        'seri',
        'avatar_car',
        'user_id',
        'type_traffic_id'
    ];

    // 1 phương tiện thuộc về 1 loại phương tiện duy nhất vd: vision, honda, sh => loại xe máy
    public function type_traffic() {
        return $this->belongsTo(type_traffic::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}
