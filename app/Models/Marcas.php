<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DBAL\TimestampType;

class Marcas extends Model
{
    //use HasFactory;
    protected $tabla = "marcas";
    protected $primarykey = "id";
    public $timestamps = false;
}
