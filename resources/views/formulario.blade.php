@extends ('tema')

@section('corresponde')

        <center>
            <H1>REGISTRO DE GRUPO</H1>
                <form action = "{{route('guardargrupo')}}" method= "POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table border = 1>
                <tr>
                <td align='left'>* NOMBRE:</td>
                <td>
                @if($errors->first('nombre'))
                    <p class="text warning">{{$errors->first('nombre')}}</p>
                    @endif
                <input type='text' name='nombre' class="form-control" value="{{old('nombre')}}" placeholder='Nombre del grupo'></td>
            </tr>
                <tr>
                <tr><td>@if($errors->first('numintegrantes'))
                        {{$errors->first('numintegrantes')}}
                         @endif <br>
                        * NÚMERO DE INTEGRANTES</td>
                    <td><input type= 'text' name = 'numintegrantes' class="form-control" value="{{old('numintegrantes')}}" placeholder='Ejemplo 8'></td>
            
                 <tr>
                    <td>@if($errors->first('division'))
                     {{$errors->first('division')}}
                     @endif <br>
                     * DIVISION QUE PERTENECE EL GRUPO</td>
                    <tr>
                    <td>
                        
                    <fieldset class="form-group">
                    <div class="form-check">        
                    <input class="form-check-input" type="radio" name="division" value="H"/>Hombres  
                    </div>
                    <div class="form-check">             
                        <input class="form-check-input" type="radio"  name="division" value="M"/>Mujeres
                    </td>
                </tr> 
                </tr>                                      
                </div>

                <tr>
                <td align='left'>* EMPRESA QUE PERTENECE</td>
                <td><select class="form-label mt-4" name='idem'>
                    @foreach($paraempresas as $em)
                    <option value ='{{$em->idem}}'>{{$em->nombre}}</option>
                    @endforeach
                    </select>
                </td>
                </tr>

                <tr>
                    <td>@if($errors->first('agrupacion'))
                 {{$errors->first('agrupacion')}}
                 @endif <br>
                * SELECCIONE ORIGEN</td>
                <tr>
                <td>
                <fieldset class="form-group">
                <div class="form-check">   
                <input class="form-check-input" type="radio"  name="agrupacion" value="H"/>Corea  
                </div>
                <div class="form-check">             
                <input class="form-check-input" type="radio"  name="agrupacion" value="M"/>Extranjero
                </td>
                </tr>
                </div>
           
                <tr>
                <td align='left'>* GENERACION QUE PERTENECE</td>
                <td><select class="form-label mt-4" name='idg'>
                    @foreach($pageneracion as $gen)
                    <option value ='{{$gen->idg}}'>{{$gen->nombre}}</option>
                    @endforeach
                    </select>
                </td>
                </tr>

                <tr>
                <td align='left'>* CLAVE OFICIAL DE REGISTRO:</td>
                <td>
                @if($errors->first('clave'))
                    <p class="text warning">{{$errors->first('clave')}}</p>
                    @endif
                <input type='text' name='clave' class="form-control" value="{{old('clave')}}" placeholder='dddLLdd'></td>
                </tr>

                <tr>
                <td align='left'>* DIRECCIÓN DE LA EMPRESA:</td>
                <td>
                @if($errors->first('direccion'))
                    <p class="text warning">{{$errors->first('direccion')}}</p>
                    @endif
                <input type='text' name='direccion' class="form-control" value="{{old('direccion')}}" placeholder='Ejempl: 8 oriente num 20'></td>
                </tr>
                <br>
                <tr>
                <td align = 'left'>* FOTO DEL GRUPO</td>
                <td>
                @if($errors->first('foto'))
                <p class="text-warning">{{$errors->first('foto')}}</p>
                @endif   
                <input type ='file' name = 'foto' class="form-control">
                </td>
            </tr>
            <tr>
                <td align = 'left'>* CONTRATO</td>
                <td>
                @if($errors->first('contrato'))
                <p class="text-warning">{{$errors->first('contrato')}}</p>
                @endif   
                <input type ='file' name = 'contrato' class="form-control">
                </td>
            </tr>
            <tr>
                <td align='right' colspan=2>
                <input type='submit' class="btn btn-warning" name='Registrar' value='Registrar'></td>
            </tr>
            <tr>
                <td align='right' colspan=2>
                    <i>Los campos con * son obligatorios</i>
                </td>
            </tr>
        </table>
        </form>
        </center>
@stop