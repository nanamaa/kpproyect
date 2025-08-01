<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empresas;
use App\Models\generaciones;
use App\Models\bandas;
use Session;

class bandacontroller extends Controller
{
    //
    public function formulario(){
        if(Session::get('sesionidu'))
        {
        $paraempresas=empresas::orderby('nombre','asc')
        ->get();

        $pageneracion=generaciones::orderby('nombre','asc')
        ->get();

        return view('formulario')
        ->with('paraempresas',$paraempresas)
        ->with('pageneracion',$pageneracion);
        }
        else{
            Session::flash('mensaje', "Es necesario iniciar sesion");
            return redirect()->route('login');   
        }

    }

    public function guardargrupo(Request $request)
{
    $this->validate($request, [
        'nombre' => 'regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
        'numintegrantes' => 'required|numeric|integer|max:10',
        'clave' => 'regex:/^[0-9]{3}[A-Z]{2}[0-9]{2}$/',
        'direccion' => 'required',
        'foto' => 'mimes:jpg,png,gif,jpeg',
        'contrato' => 'mimes:pdf,docx'
    ]);
    
    
    $file = $request->file('foto');
    if ($file != '')
    {
    $fecha = date_create();
    $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
    \Storage::disk('local')->put($img, \File::get($file));
        }
        else{
            $img= 'nofoto.JPG';
        }

         /*$doccon = '';
            $con = $request->file('contrato');
            if ($con) {
                $doccon = $con->store('public');
                $doccon = str_replace('public/', 'storage/', $doccon);
            }*/

            $documento='';
            $doc = $request->file('contrato');
            if($doc !='')
            {
            $fecha = date_create();
            $documento = date_timestamp_get($fecha) . $doc->getClientOriginalName();
            \Storage::disk('local2')->put($documento, \File::get($doc));
            }
    
           //return $request;
    

            $bandas = new bandas;
            $bandas->nombre = $request->nombre;
            $bandas->numintegrantes = $request->numintegrantes;
            $bandas->division = $request->division;
            $bandas->agrupacion = $request->agrupacion;
            $bandas->clave = $request->clave;
            $bandas->direccion = $request->direccion;
            $bandas->idem = $request->idem;
            $bandas->idg = $request->idg;
            $bandas->foto = $img;
            $bandas->contrato = $documento;

            $bandas->save();
            Session::flash('mensaje', "El grupo $request->nombre se ha guardado correctamente");
            return redirect()->route('reportegrupo');
        }

    

    public function reportegrupo()
    {
        if(Session::get('sesionidu'))
        {
        $consulta = \DB::select("SELECT b.idb, b.nombre as gru, b.numintegrantes, b.direccion, 
        e.nombre as e, b.foto,b.contrato
            FROM bandas AS b
            INNER JOIN generaciones AS g ON g.idg = b.idg
            INNER JOIN empresas AS e ON e.idem = b.idem");
    
        return view('reportegrupos')->with('consulta', $consulta);
    }
    else{
        Session::flash('mensaje', "Es necesario iniciar sesion");
        return redirect()->route('login');   
        }
}
    

    public function modificarban($idb)
    {
        if(Session::get('sesionidu'))
        {
        $infbanda = \DB::select("SELECT  b.idb,b.contrato,b.nombre, b.numintegrantes,b.foto,
         b.division, b.agrupacion, b.clave, b.direccion,
         e.idem, g.idg,e.nombre as empresas, g.nombre as generaciones
        FROM bandas as b 
        INNER JOIN generaciones AS g ON g.idg = b.idg
        INNER JOIN empresas AS e ON e.idem = b.idem
        WHERE idb = $idb");

        if($infbanda[0]->contrato !='')
        {
        $archivo = explode('.',$infbanda[0]->contrato);
        $extension = $archivo[1];
        }
        else
        {
        $extension = 'NA';
        }
        $empresas = empresas::where('idem','<>',$infbanda[0]->idem)
                    ->orderby('nombre','Asc')
                    ->get();

        $generaciones = generaciones::where('idg','<>',$infbanda[0]->idg)
                    ->orderby('nombre','Asc')
                    ->get();
        //return $infbanda;
        return view('editabanda')
       ->with('infbanda',$infbanda[0])
       ->with('empresas',$empresas)
       ->with('generaciones',$generaciones)
       ->with('extension',$extension);
    }
    else{
        Session::flash('mensaje', "Es necesario iniciar sesion");
        return redirect()->route('login');   
        }
        
    }

    public function cambio(request $request)
    {

        $this->validate($request,[
            'nombre'=>'regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'numintegrantes'=>'required|numeric|integer|max:10',
            //'clave'=>'regex:/^[0-9]{3}[A-Z]{2}[0-9]{2}$/',
            'direccion'=>'required',
            'foto' =>'mimes:jpg,jpeg,png,JPG',
            'contrato' => 'mimes:pdf,docx',
        ]);
        $file = $request->file('foto');
        if ($file != '')
        {
        $fecha = date_create();
        $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
        \Storage::disk('local')->put($img, \File::get($file));
        }
        
        
        $bandas=bandas::find($request->idb);
        $bandas->nombre=$request->nombre;
        $bandas->numintegrantes=$request->numintegrantes;
        $bandas->division=$request->division;
        $bandas->agrupacion=$request->agrupacion;
        $bandas->clave=$request->clave;
        $bandas->direccion=$request->direccion;
        $bandas->idem=$request->idem;
        $bandas->idg=$request->idg;
        if ($file != '')
        {
        $bandas->foto = $img;
        }

       /* $contratoFile = $request->file('contrato');
        if ($contratoFile) {
            // Procesar el contrato aquí
        }*/
        $documento = $request->file('contrato');
        if ($documento) {
            $doc = time() . '_' . $documento->getClientOriginalName();
            \Storage::disk('local2')->putFileAs('documento', $documento, $doc);
            $bandas->contrato = $doc;
        }
    
        $bandas->save();
        Session::flash('mensaje',"El grupo $request->nombre se ha modificado correctamente");
        return redirect()->route('reportegrupo');
    }

    public function eliminabanda($idb){ 
        $borrabanda =  \DB::delete("delete from bandas where idb = $idb");

        Session::flash('mensaje', "La banda con clave $idb  ha sido eliminada");
        return redirect()->route('reportegrupo');
    }


}
