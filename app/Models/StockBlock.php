<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class StockBlock extends Model
{
    use HasFactory;
    protected $hidden = ['id','created_at', 'updated_at'];
}
