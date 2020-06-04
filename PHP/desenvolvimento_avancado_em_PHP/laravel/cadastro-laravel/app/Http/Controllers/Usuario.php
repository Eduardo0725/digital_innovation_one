<?php

namespace App\Http\Controllers;

use App\Model\Usuario as ModelUsuario;
use Illuminate\Http\Request;
use Hash;

class Usuario extends Controller
{
    public function cadastrar(){
        echo view('usuario.cadastro');
    }

    public function salvar(Request $request){
        
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'senha' => 'min:5'
        ]);

        // dd($request->all());

        if(ModelUsuario::cadastrar($request)){
            return view('usuario.sucesso', [
                'nome' => $request->input('nome')
            ]);
        }else{
            echo "Ops, erro ao cadastrar!";
        }

        return;
    }
}
