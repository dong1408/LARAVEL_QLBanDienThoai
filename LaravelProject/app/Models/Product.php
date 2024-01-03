<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'codeProduct',
        'price',
        'amount',
        'shortDesc',
        'detailDesc',
        'imageUrl',       
        'category_id' 
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function orderDetails(){
        return $this->hasMany('App\Models\OrderDetail');
    }
}