<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bandas;
use App\Models\conci_detalles;
use App\Models\conciertos;
use App\Models\lugares;
use App\Models\Tipoboletos;
use App\Models\asientos;
use App\Models\areas;
use App\Models\ventas;
use App\Models\boletosinfo;
use App\Models\fechasguarda;
use App\Models\detalleventas;
use App\Models\tboletos;

use Session;
class boletoscontroller extends Controller
{
    //
    public function form1(){
        $ultimaVenta = \DB::table('ventas')->orderBy('idven', 'desc')->first();
        $numventa = $ultimaVenta ? $ultimaVenta->idven + 1 : 1; 
        $fechahoy=date('Y-m-d');
        $banda = bandas::all();
        return view('boletos.form1')
        ->with('numventa', $numventa)
        ->with('fechahoy', $fechahoy)
        ->with('banda', $banda);
    }

    public function boletosinfo(Request $request) {
        $fechaconci= \DB::select("SELECT dc.idcinf, dc.fechas, c.idb 
        FROM conci_detalles AS dc
        INNER JOIN conciertos AS c ON c.idc= dc.idc
        WHERE c.idb= $request->idb");

        $conciertos = \DB::select(
            "SELECT dc.idcinf, dc.fechas as fechas, dc.idlugar, l.nombre AS ubicacion, c.asientos AS total_asientos, c.idb 
            FROM conci_detalles AS dc 
            INNER JOIN conciertos AS c ON c.idc = dc.idc 
            INNER JOIN lugares AS l ON l.idlugar = dc.idlugar 
            WHERE c.idb = ?", 
            [$request->idb] 
        );
        //return $conciertos;
            return view('boletos.boletosinfo')
            ->with('conciertos', $conciertos[0] ?? null)
            ->with('fechaconci',$fechaconci);
        
    }    
    public function registracarrito(Request $request)
{
    $ventas = new ventas;

    $ventas->fecha = $request->fechahoy;
    $ventas->idb = $request->idb;
    $ventas->fechaconcierto = $request->fechaconcierto;
    $ventas->ubicacion = $request->ubicacion;
    $ventas->idbol = $request->idbol;
    $ventas->cantidad = $request->cantidad;
    $ventas->idpromocion = $request->promocion;
    $ventas->id_asientos = $request->id_asientos;
    $ventas->save();
    $idGenerado = $ventas->idven;

    // Almacenar el idven en la sesión
    session(['idven' => $idGenerado]);

    // Consulta de ventas para mostrar en la vista
    $consultaventas = \DB::select("SELECT v.idven AS turno, v.idbol, tp.tipo AS boleto , v.idb, 
        b.nombre, v.cantidad AS cantidad, p.nombre AS promocion, v.totalpago
        FROM ventas AS v
        INNER JOIN bandas AS b ON b.idb= v.idb
        INNER JOIN tipoboletos AS tp ON tp.idbol= v.idbol
        INNER JOIN promociones AS p ON p.idpromocion= v.idpromocion
        WHERE v.idven = $idGenerado");

    return view('boletos.boletosdetalle')->with('consultaventas', $consultaventas);
}


    public function tiposboletos(request $request)
    {
    
            $boletos = Tipoboletos::all();
            
            /*$idbol=\DB::select("SELECT tb.costo
            FROM tipoboletos AS tb");*/
            //return $boletos;
            return view('boletos.tiposboletos')
            ->with('boletos', $boletos);
        
    
    }
    

    public function preciosboletos(request $request){


            $opc=$request->opc;
            $precio = \DB::table('tipoboletos')->where('idbol', $opc)->value('costo');
    
        return view('boletos.preciosboletos')
        ->with('opc', $opc)
        ->with('precio', $precio);
    }

    public function cargapromociones(request $request){

        $opc=$request->opc;
        $asientos = \DB::select("SELECT a.id_asientos, a.fila, ar.nombre as areaa
        FROM asientos AS a
        INNER JOIN areas AS ar ON ar.id_area = a.id_area");


        return view('boletos.promocionesboletos')
        ->with('opc',$opc)
        ->with('asientos',$asientos);
    }

    public function promocionesprecio(Request $request) {
        $precios = [
            1 => 879.99, 2 => 900, 3 => 566.89,
            4 => 345.76, 5 => 784.80, 6 => 600,
            7 => 400, 8 => 300
        ];
    
        // Verificar si la promoción existe en el array, si no, devolver 0
        $promo = $request->promo;
        $pre = isset($precios[$promo]) ? $precios[$promo] : 0;
    
        return response()->json(['pre' => $pre]);
    }

    public function agregarasientos(request $request)
     {
        $boletos= \DB::select("SELECT b.idbol, b.tipo, b.costo
        FROM tipoboletos AS b");

        $fechaconci= \DB::select("SELECT cd.idcinf, cd.fechas as fechas, cd.idc, c.idb, b.nombre
        FROM conci_detalles AS cd
        INNER JOIN conciertos AS c ON c.idc= cd.idc
        INNER JOIN bandas AS b ON b.idb= c.idb
        ORDER BY b.nombre");

        
        return view ('asientos.agregarasiento')
        ->with('boletos',$boletos)
        ->with('fechaconci',$fechaconci);

        }

        public function tablaboletos(request $request)
        {
             
             $consultaventas = \DB::select("SELECT v.idven AS turno, v.idbol, tp.tipo AS boleto , v.idb, 
             b.nombre, v.cantidad AS cantidad, p.nombre AS promocion, v.totalpago
             FROM ventas AS v
             INNER JOIN bandas AS b ON b.idb= v.idb
             INNER JOIN tipoboletos AS tp ON tp.idbol= v.idbol
             INNER JOIN promociones AS p ON p.idpromocion= v.idpromocion
                 WHERE v.idven = ?
             ", [$idven]);

            return view('boletos.boletosdetalle', compact('consultaventas'));
        }

        public function guardanuevoasiento(Request $request)
        {
            $idven = session('idven');

            if ($idven) {
                // Guardamos el nuevo asiento
                $detalleventas = new detalleventas;
                $detalleventas->boleto = $request->idbol;
                $detalleventas->cantidad = $request->cantidad;
                $detalleventas->fechaconcierto = $request->fechaconcierto;
                $detalleventas->idven = $idven;
                $detalleventas->save();

                 // Consultar el nuevo asiento agregado
                $nuevoAsiento = \DB::select("SELECT dt.idven AS turno, dt.boleto AS boleto, dt.fechaconcierto, dt.cantidad AS cantidad
                FROM detalleventas AS dt
                INNER JOIN ventas AS v ON v.idven= dt.idven
                WHERE v.idven = ? ", [$idven]);

                // Retornar solo la nueva fila que se debe agregar a la tabla
                return view('boletos.filaasiento', compact('nuevoAsiento'));
            } else {
                return response()->json(['error' => 'No se encontró la venta.'], 400);
            }
        }

        public function reporteboletos()
        {
            

        $reportetotal =\DB::select("SELECT v.idven AS turno, 
       v.fecha AS fechasolicitud, v.idb, b.nombre AS banda, v.fechaconcierto, 
       v.ubicacion AS ubicacion, v.idbol, tp.tipo, 
       v.cantidad AS totalboletos, v.idpromocion, p.nombre AS promocion, 
       v.id_asientos, a.fila AS lugar, 
       a.id_area, ar.nombre AS areanombre
        FROM ventas AS v
        INNER JOIN bandas AS b ON b.idb = v.idb
        INNER JOIN tipoboletos AS tp ON tp.idbol = v.idbol
        INNER JOIN promociones AS p ON p.idpromocion = v.idpromocion
        INNER JOIN asientos AS a ON a.id_asientos = v.id_asientos
        INNER JOIN areas AS ar ON ar.id_area = a.id_area
        INNER JOIN detalleventas AS dt ON dt.idven = v.idven
        GROUP BY v.idven, v.fecha, v.idb, b.nombre, v.fechaconcierto, v.ubicacion, v.idbol, tp.tipo, 
                v.cantidad, v.idpromocion, p.nombre, v.id_asientos, a.fila, a.id_area, ar.nombre");

            return view('asientos.reporteboletos')
            ->with('reportetotal',$reportetotal);
        }

}