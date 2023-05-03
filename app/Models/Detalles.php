<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DBAL\TimestampType;

class Detalles extends Model
{
    //use HasFactory;
    protected $tabla = "detalles";
    protected $primaryKey = "id_det";
    public $timestamps = false;
}
