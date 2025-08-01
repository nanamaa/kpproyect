@extends('tema')

@section('corresponde')
    <center>
        <h1>REGISTRO DE GRUPO</h1>
        <form action="{{ route('cambio') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idb" value="{{$infbanda->idb}}" >

            {{ csrf_field() }}
            <table border="1">
                <tr>
                    <td align="left">* NOMBRE:</td>
                    <td>
                        @if($errors->first('nombre'))
                            <p class="text warning">{{ $errors->first('nombre') }}</p>
                        @endif
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del grupo" value="{{$infbanda->nombre}}">
                    </td>
                </tr>
                <tr>
                    <td>
                        @if($errors->first('numintegrantes'))
                            {{ $errors->first('numintegrantes') }}
                        @endif
                        <br>* NÚMERO DE INTEGRANTES
                    </td>
                    <td>
                        <input type="text" name="numintegrantes" class="form-control" placeholder="Ejemplo 8" value="{{$infbanda->numintegrantes}}">
                    </td>
                </tr>
                <tr>
                    <td>
                        @if($errors->first('division'))
                            {{ $errors->first('division') }}
                        @endif
                        <br>* DIVISION QUE PERTENECE EL GRUPO
                    </td>
                    <td>
                        <fieldset class="form-group">
                            <div class="form-check"> 
                                @if($infbanda->division=='H')       
                                    <input class="form-check-input" type="radio" name="division" value="H" checked/> Hombres <br>
                                    <input class="form-check-input" type="radio" name="division" value="M"/> Mujeres <br> 
                                @else
                                    <input class="form-check-input" type="radio" name="division" value="M" checked/> Mujeres <br>
                                    <input class="form-check-input" type="radio" name="division" value="H"/> Hombres <br>
                                @endif
                            </div>
                        </fieldset>
                    </td>
                </tr> 
                <tr>
                    <td align="left">* EMPRESA A LA QUE PERTENECE:</td>
                    <td>
                        <select name="idem" class="form-select">
                            <option value='{{ $infbanda->idem }}'>{{ $infbanda->empresas}}</option>
                            @foreach($empresas as $e)
                                <option value="{{ $e->idem }}">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if($errors->first('agrupacion'))
                            {{ $errors->first('agrupacion') }}
                        @endif
                        <br>* SELECCIONE ORIGEN
                    </td>
                    <td>
                        <fieldset class="form-group">
                            <div class="form-check">
                                @if($infbanda->division =='H')   
                                    <input class="form-check-input" type="radio" name="agrupacion" value="H" checked/> Corea<br>
                                    <input class="form-check-input" type="radio" name="agrupacion" value="M"/> Extranjero<br>
                                @else
                                    <input class="form-check-input" type="radio" name="agrupacion" value="H" checked/> Corea  <br>           
                                    <input class="form-check-input" type="radio" name="agrupacion" value="M" checked/> Extranjero<br>
                                @endif
                            </div>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td align="right">* GENERACION A LA QUE PERTENECE:</td>
                    <td>
                        <select name="idg" class="form-select">
                            <option value='{{ $infbanda->idg }}'>{{ $infbanda->generaciones }}</option>
                            @foreach($generaciones as $g)
                                <option value="{{ $g->idg }}">{{ $g->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="left">* CLAVE OFICIAL DE REGISTRO</td>
                    <td>
                        @if($errors->first('clave'))
                            {{ $errors->first('clave') }}
                        @endif
                        <input type="text" name="clave" class="form-control" value="{{ $infbanda->clave }}">
                    </td>
                </tr>
                <tr>
                    <td align="left">* DIRECCIÓN DE LA EMPRESA</td>
                    <td>
                        @if($errors->first('direccion'))
                            {{ $errors->first('direccion') }}
                        @endif
                        <input type="text" name="direccion" class="form-control" value="{{ $infbanda->direccion }}">
                    </td>
                </tr>
                <tr>
                    <td align = 'right'>* FOTO </td>
                    <td>
                    @if($errors->first('foto'))
                    <p class="text-warning">{{$errors->first('foto')}}</p>
                    @endif  
                    <a href = "{{asset('archivos/'.$infbanda->foto)}}" target ='_blank'>
                    <img src = "{{asset('archivos/'.$infbanda->foto)}}" height =100 width=100> 
                    </a>
                    
                    <input type ='file' name = 'foto' class="form-control">
                    </td>
                </tr>
                <tr>
                    <td align = 'right'>* CONTRATO</td>
                    <td>
                    @if($errors->first('contrato'))
                    <p class="text-warning">{{$errors->first('contrato')}}</p>
                    @endif 
                    @if($extension =='pdf' or $extension =='PDF' )
                    <a href = "{{asset('documento/'.$infbanda->contrato)}}" target ='_blank'>
                    <img src = "{{asset('archivos/pdf.PNG')}}" height =100 width=100>
                    </a>
                    @elseif($extension =='docx' or $extension =='DOCX' )
                    <a href = "{{asset('documento/'.$infbanda->contrato)}}" target ='_blank'>
                    <img src = "{{asset('archivos/word.PNG')}}" height =100 width=100>
                    </a>
                    @else
                    <img src = "{{asset('archivos/noarchivo.PNG')}}" height =100 width=100>
                    @endif
                
                    <input type ='file' name = 'contrato' class="form-control">
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2">
                    @if(Session::get('sesiontipo')=='Administrador')
                        <input type="submit" class="btn btn-warning" name="Registrar" value="Guardar">
                    </td>
                    @endif
                </tr>
                <tr>
                    <td align="right" colspan="2">
                        <i>Los campos con * son obligatorios</i>
                    </td>
                </tr>
            </table>
        </form>
    </center>
@stop
