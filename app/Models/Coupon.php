<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'status',
        'discount'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'coupon_id');
    }
}
