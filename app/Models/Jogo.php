<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Palavra;

class Jogo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'idPalavra', 'data'
    ];
    protected $table = "pc_jogo";

    public function palavra()
    {
        return $this->hasOne(Palavra::class);
    }
}
