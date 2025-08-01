<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tboletos extends Model
{
    use HasFactory;
    protected $primaryKey='id_tboletos';
    protected $fillable =['id_tboletos','idbol','cantidad'];
}
