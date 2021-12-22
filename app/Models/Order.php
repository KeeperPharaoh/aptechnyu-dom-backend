<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['cart_id','quantity','product'];

    protected $hidden   = [
        'created_at',
        'updated_at'
    ];
}
