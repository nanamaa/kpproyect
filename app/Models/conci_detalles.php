<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conci_detalles extends Model
{
    use HasFactory;
    protected $primaryKey='idcinf';
    protected $fillable =['idcinf','idc','fechas','idlugar'];
}
