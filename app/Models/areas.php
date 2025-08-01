<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areas extends Model
{
    use HasFactory;
    protected $primaryKey='id_area';
    protected $fillable =['id_area','nombre'];
}
