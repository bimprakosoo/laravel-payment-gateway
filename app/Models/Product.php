<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  protected $table = 'products';
  use SoftDeletes;
  
  protected $fillable = [
    'name',
    'price'
  ];
}
