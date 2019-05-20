<?php

namespace App\Http\Controllers;
use App\Usuario;
use DataTables;
use DateTime;
use Redirect,Response;

use Illuminate\Http\Request;

class UsuarioAjaxController extends Controller
{
    public function listarUsuario(){
        if(request()->ajax()) {
            return datatables()->of(Usuario::select('*'))
            ->addColumn('action', 'action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('usuarioAjax');
    }

    public function criarUsuario(Request $request){
        $date = new DateTime($request->dnascimento);
        $userId = $request->user_id;
        $user   =   Usuario::updateOrCreate(['id' => $userId],
                ['nome' => $request->nome, 'email' => $request->email, 'senha' => $request->email, 'datanascimento' => $date->format('Y-m-d')]);        
        return Response::json($user);
    }

    public function atualizarUsuario($id)
    {   
        $where = array('id' => $id);
        $user  = Usuario::where($where)->first();
    
        return Response::json($user);
    }

    public function deletarUsuario($id)
    {  
        $user = Usuario::where('id',$id)->delete();
 
        return Response::json($user);
    }
}
