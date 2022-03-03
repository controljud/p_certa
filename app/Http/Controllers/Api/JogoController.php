<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TipoJogo;

class JogoController extends Controller
{
    public function setTipoJogo(Request $request)
    {
        $tipo = $request->tipo;

        
    }

    public function getPalavraCerta()
    {
        return response()->json([
            'status' => 0,
            'message' => '',
            'data' => [
                'palavraCerta' => strtoupper('rampa'),
                'dia' => 2,
            ]
        ]);
    }
}
