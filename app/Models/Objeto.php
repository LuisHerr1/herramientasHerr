<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DBAL\TimestampType;

class Objeto extends Model
{
    //use HasFactory;
    protected $tabla = "objetos";
    protected $primaryKey = "id_obj";
    public $timestamps = false;
}
