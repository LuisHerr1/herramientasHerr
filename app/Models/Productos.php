<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DBAL\TimestampType;

class Productos extends Model
{
    //use HasFactory;
    protected $tabla = "productos";
    protected $primaryKey = "id";
    public $timestamps = false;
}
