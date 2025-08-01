<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asientos extends Model
{
    use HasFactory;
    protected $primaryKey='id_asientos';
    protected $fillable =['id_asientos','fila','area'];
}
