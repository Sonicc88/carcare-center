<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'emp_name',
        'emp_surname',
        'address',
        'contract',
        'gender',
        'email',
        'username',
        'password',
        'is_admin'
    ];
}
