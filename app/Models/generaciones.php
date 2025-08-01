<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generaciones extends Model
{
    use HasFactory;
    protected $primaryKey='idg';
    protected $fillable =['idg','nombre'];
}
