<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DBAL\TimestampType;

class Categorias extends Model
{
    //use HasFactory;
    protected $tabla =  "categorias";
    protected $primaryKey = "id";
    public $timestamps = false;
}
