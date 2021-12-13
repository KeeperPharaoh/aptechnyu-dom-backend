<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Article extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];
}
