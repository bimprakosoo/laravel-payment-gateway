<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  protected $table = 'orders';
  use SoftDeletes;
  
  protected $fillable = [
    'id_user',
    'id_product',
    'total',
    'status'
  ];
}
