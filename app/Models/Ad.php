<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['user_id', 'title', 'text', 'price', 'image'];
}
