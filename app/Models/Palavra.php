<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TipoPalavra;

class Palavra extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'idTipoPalavra', 'palavra'
    ];
    protected $table = "pc_palavra";

    public function tipo()
    {
        return $this->hasOne(TipoPalavra::class);
    }
}
