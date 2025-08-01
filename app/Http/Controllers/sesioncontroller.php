<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarios;
use Session;

class sesioncontroller extends Controller
{
    //
    public function inicio()
    {
        if(Session::get('sesionidu'))
        {
        return view ('inicio');
        }
        else{
            Session::flash('mensaje', "Es necesario iniciar sesion");
            return redirect()->route('login');   
        }
    }

    public function login()
    {
        return view ('sesion');
    }

    public function verificar(Request $request)
    { 
        $correo = $request->correo;
        $contra = md5($request->contra);
        
        $acceso = usuarios::where('correo','=',$correo)
                            ->where('contra','=',$contra)
                            ->where('activo','=','Si')
                            ->get();
        $cuantos = count($acceso);

        if ($cuantos==0)
        {
            Session::flash('mensaje', "EL USUARIO O LA CONTRASEÑA SON INCORRECTOS");
            return redirect()->route('login');
        }
        else
        {
            Session::put('sesionname',$acceso[0]->nombre . ' ' . $acceso[0]->apellido );
            Session::put('sesionidu',$acceso[0]->idu);
            Session::put('sesiontipo',$acceso[0]->tipo);

            return redirect()->route('inicio');
        }
       
    }

    public function cerrarsesion()
    {
       Session::forget('sesionname');
       Session::forget('sesionidu');
       Session::forget('sesiontipo');
       Session::flush();
       Session::flash('mensaje', 'SE HA CERRADO SESIÓN');
       return redirect()->route('login');
    }
}
