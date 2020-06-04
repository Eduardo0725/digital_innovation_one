<?php

namespace App\Model;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Hash;

class Usuario extends Model
{
    protected $connection = 'sqlite';
    protected $table = 'usuario';

    public static function listar(int $limit){
        $sql = self::select([
            'id',
            'nome',
            'email',
            'senha',
            'data_cadastro'
        ])
        ->limit($limit);

        // dd($sql->toSql());
        return $sql->get();
    }

    public static function cadastrar(Request $request){
        // DB::enableQueryLog();

        try{
            return self::insert([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'senha' => Hash::make($request->input('senha')),
                'data_cadastro' => new Carbon()
            ]);
        }catch (Exception $e){
            return;
        }

        // dd(DB::getQueryLog());
    }
}
