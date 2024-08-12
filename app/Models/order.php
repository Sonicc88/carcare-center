<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'car_brand',
		'car_model', 
        'car_plate',
        'order_status',
	];
    public function order(){
        return $this->hasOne(order_detail::class,'order_id','id');
    }
}
