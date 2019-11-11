@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('prestaciones.index') }}">prestaciones</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>
    
    <form method="post" action="{{ route('prestaciones.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $prestacion->id }}" >
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 offset-pd-4 {{ $errors->has('codigo') ? 'has-error' : '' }}">
                    <label>Código de la prestacion *</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $prestacion->codigo ?: old('codigo') }}">
                    @if ($errors->has('codigo'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                    <label>Nombre de la prestacion *</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $prestacion->nombre ?: old('nombre') }}">
                    @if ($errors->has('nombre'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group has-feedback col-xs-6 col-md-6 col-lg-9 {{ $errors->has('fonasa') ? 'has-error' : '' }}">
                <div class="radio">
                    <br>
                    <label>Fonasa  </label>
                    @if($prestacion->valor_1 == null && $prestacion->valor_2 == null && $prestacion->valor_3 == null && $prestacion->nombre !=null)
                        <label><input type="radio" name="fonasa" value="1">  Sí</label>
                        <label><input type="radio" name="fonasa" value="0" checked="true">  No</label>
                    @else
                        <label><input type="radio" name="fonasa" value="1" checked="true">  Sí</label>
                        <label><input type="radio" name="fonasa" value="0">  No</label>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div name="l_valor_1" class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('valor_1') ? 'has-error' : '' }}">
                    <label>Valor Nivel 1</label>
                    <input id="valor_1" type="text" name="valor_1" class="form-control" value="{{ $prestacion->valor_1 ?: old('valor_1') }}">
                    @if ($errors->has('valor_1'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('valor_1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div name="l_valor_2" class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('valor_2') ? 'has-error' : '' }}">
                    <label>Valor Nivel 2</label>
                    <input type="text" name="valor_2" class="form-control" value="{{ $prestacion->valor_2 ?: old('valor_2') }}">
                    @if ($errors->has('valor_2'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('valor_2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div name="l_valor_3" class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('valor_3') ? 'has-error' : '' }}">
                    <label>Valor Nivel 3</label>
                    <input type="text" name="valor_3" class="form-control" value="{{ $prestacion->valor_3 ?: old('valor_3') }}">
                    @if ($errors->has('valor_3'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('valor_3') }}</strong>
                        </span>
                    @endif
                </div>
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
            var radioValue = $("input[name='fonasa']:checked").val();
            if(radioValue == 0){
                $("div[name='l_valor_1']").hide();
                $("div[name='l_valor_2']").hide();
                $("div[name='l_valor_3']").hide();
            }else{
                $("div[name='l_valor_1']").show();
                $("div[name='l_valor_2']").show();
                $("div[name='l_valor_3']").show();
            }
        });
        $("input[type='radio']").ready(function(){
            var radioValue = $("input[name='fonasa']:checked").val();
            if(radioValue == 0){
                $("div[name='l_valor_1']").hide();
                $("div[name='l_valor_2']").hide();
                $("div[name='l_valor_3']").hide();
            }else{
                $("div[name='l_valor_1']").show();
                $("div[name='l_valor_2']").show();
                $("div[name='l_valor_3']").show();
            }
        });
    });
</script>
@endrole
@stop