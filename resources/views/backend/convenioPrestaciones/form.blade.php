@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @foreach($conveniosData as $entityId => $entityValue)
                @foreach($razon_socialData as $entityId2 => $entityValue2)
                    @if($entityId2 == $entityValue)
                        <a href="{{ route('convenioPrestaciones.index', $convenio) }}">Prestaciones del convenio con {{$entityValue2}}</a>
                    @endif
                @endforeach
            @endforeach
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>
    
    <form method="post" action="{{ route('convenioPrestaciones.save', [$convenio, $prestacion->id]) }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}

        <input type="hidden" name="id" value="{{ $cPrestacion->id }}" > <!-- código de la tabla interseccion convenioPrestacion -->

        <div class="row col-12">
            <div name="divPrestacion" class="form-group has-feedback col-xs-4 col-md-4 col-lg-4">
                <input type="hidden" name="prestacion_id" class="form-control" value="{{$prestacion->id}}">
                <label>Código Prestación : <b>{{$prestacion->codigo}}</b></label>
                <label>Nombre Prestación : <b>{{$prestacion->nombre}}</b></label>
            </div>
        </div>

        <div name="divRadioPrestacion" class="form-group has-feedback col-xs-6 col-md-6 col-lg-9 {{ $errors->has('prestacion_id') ? 'has-error' : '' }}">
            <div class="radio">
                <label> Valor prestación *</label>

                <input type="hidden" name="valor_prestacion_old" value="{{old('valor_prestacion')}}"> <!-- pretendía mostrar el valor antiguo -->

                <div class="row col-12">
                    <label> <input type="radio" id="valor_prestacion_1" name="valor_prestacion" value="{{$prestacion->valor_1}}">  Valor nivel 1 :  <b>{{$prestacion->valor_1}}</b></label>
                </div>
                <div class="row col-12">
                    <label> <input type="radio" id="valor_prestacion_2" name="valor_prestacion" value="{{$prestacion->valor_2}}">  Valor nivel 2 :  <b>{{$prestacion->valor_2}}</b></label>
                </div>
                <div class="row col-12">
                    <label> <input type="radio" id="valor_prestacion_3" name="valor_prestacion" value="{{$prestacion->valor_3}}">  Valor nivel 3 :  <b>{{$prestacion->valor_3}}</b></label>
                </div>
                <div class="row col-12">
                    <label> <input type="radio" id="valor_prestacion_0" name="valor_prestacion" value="0">  Ingresar valor : </label>
                    <div class="ml-3"><input type="number" name="precio_total" class="form-control"></div>
                </div>

                <input type="hidden" name="valor_seleccionado">
                
                @if ($errors->has('precio_total'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('precio_total') }}</strong>
                    </span>
                @endif
             </div>
        </div>
        <div name="divFactor" class="row col-12">
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('factor') ? 'has-error' : '' }}">
                <label>Factor precio</label>
                <input type="number" name="factor" min="0" class="form-control" value="{{ 1 }}" step=".01">
                @if ($errors->has('factor'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('factor') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="card-footer">
        <div class="row">
            <div class="col-sm-8">
            <button type="submit" class="btn-primary btn rounded" ><i class="icon-floppy-disk"></i> Guardar</button>
            </div>
        </div>
        </div>

    </div>
  </form>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("input[type='radio']").click(function(){
            var radioValue = $("input[name='boleta']:checked").val();
            if(radioValue == 0){
                $("div[name='Agregar']").hide();
                $("div[name='Asignar']").show();
                
            }else{
                $("div[name='Agregar']").show();
                $("div[name='Asignar']").hide();
                
            }
            var radioValue2 = $("input[name='valor_prestacion']:checked").val();
            $("input[name='valor_seleccionado']").val(radioValue2); 
            if(radioValue2 == 0){
                $("div[name='divFactor']").hide();   
                $("input[name='precio_total']").val('');  
                $("input[name='precio_total']").show();    
            }else{
                $("div[name='divFactor']").show();  
                $("input[name='precio_total']").hide(); 
                //calcular precio_total:
                var factorValue = $("input[name='factor']").val(); 

                $("input[name='precio_total']").val(radioValue2*factorValue);
            }
        });
        $("div[name='divFactor']").change(function(){
            if($("input[name='valor_prestacion']:checked").val()){
                //calcular precio_total:
                var radioValue2 = $("input[name='valor_prestacion']:checked").val();
                var factorValue = $("input[name='factor']").val();
                var resultado = parseInt(radioValue2*factorValue);
                $("input[name='precio_total']").val(resultado);
            }
        });
        $("input[type='radio']").ready(function(){
            var radioValue = $("input[name='boleta']:checked").val();
            if(radioValue == 0){
                $("div[name='Agregar']").hide();
                $("div[name='Asignar']").show();
            }else{
                $("div[name='Agregar']").show();
                $("div[name='Asignar']").hide();
            }
            $("input[name='precio_total']").hide();
            
        });
    });
</script>
@endrole
@stop