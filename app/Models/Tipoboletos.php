<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoboletos extends Model
{
    use HasFactory;
    protected $primaryKey='idbol';
    protected $fillable =['idbol','tipo','costo'];

}
