<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donut extends Model
{
    protected $table = 'donuts';
    protected $fillable = ['name', 'price', 'seal_of_approval'];
}
