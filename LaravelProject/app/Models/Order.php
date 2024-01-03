<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected  $fillable = [
        'fullname',
        'email',
        'address',
        'phoneNumber',
        'note',
        'payMethod',
        'amount',
        'total',
        'customerID',
        'orderstatus_id'
    ];

    public function orderDetails(){
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function orderStatus(){
        return $this->belongsTo('App\Models\OrderStatus','orderstatus_id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\User', 'customerID');
    }
}
