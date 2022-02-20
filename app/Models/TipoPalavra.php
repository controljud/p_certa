<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPalavra extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tipo'
    ];
    protected $table = "pc_tipo_palavra";
}
