<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fechasguarda extends Model
{
    use HasFactory;
    protected $primaryKey='id_fechaguarda';
    protected $fillable =['id_fechaguarda','idven','fecha','idb'];
}
