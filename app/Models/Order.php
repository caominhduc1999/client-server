<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'notes',
        'phone',
        'email',
        'address',
        'payment_method_id'
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function getStatusName()
    {
        switch ($this->status) {
            case 1:
                return 'Confirming';
                break;
            case 2:
                return 'Preparing';
                break;
            case 3:
                return 'Shipping';
                break;
            case 4:
                return 'Done';
                break;
            default:
                return 'Pending';
                break;
        }
    }
}
