<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Usuario as ModelUsuario;
use Illuminate\Http\Request;

class Usuario extends Controller
{
    public function salvar(Request $request){
        // return dd($request->all());
        if(ModelUsuario::cadastrar($request)){
            return response('ok', 200);
        }else{
            return response("erro", 409);
        }
    }
}
