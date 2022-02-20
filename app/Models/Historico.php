<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TipoPalavra;
use App\Models\User;
use App\Models\Jogo;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'idJogo', 'idUser', 'colocacao'
    ];
    protected $table = "pc_historico";

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function jogo()
    {
        return $this->hasOne(Jogo::class);
    }
}
