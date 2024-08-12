<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'id',
        'order_id',
        'service_id',
        'price',
        'user_id',
	];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
