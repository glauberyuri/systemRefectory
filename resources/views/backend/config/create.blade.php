@extends('layouts.layout')
@push('css')
@endpush
@section('title')
    Configurações do sistema
@endsection
@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="col-lg-12">
                            <div class="card">
                                    <div class="card-header">
                                        Configurações do sistema
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="form-create-config" method="post" class="form-horizontal">
                                            @csrf
                                            <div class="row form-group">
                                                    <div class="col-4">
                                                        <label for="cc-payment" class="control-label mb-1"> Valor da refeição</label>
                                                        <input type="text" id="config_value" name="config_value"  value="{{$config->config_value}}" placeholder=".col-6" class="form-control">
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-4">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario inicial almoco</label>
                                                    <input type="time" id="config_ini_lunch"  value="{{date('H:i', strtotime($config->config_ini_lunch))}}" name="config_ini_lunch" placeholder=".col-4" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario Final almoco</label>
                                                    <input type="time" id="config_end_lunch" name="config_end_lunch"  value="{{date('H:i', strtotime($config->config_end_lunch))}}" placeholder=".col-8" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-4">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario inicial jantar</label>
                                                    <input type="time" id="config_ini_dinner" name="config_ini_dinner" value="{{date('H:i', strtotime($config->config_ini_dinner))}}" placeholder=".col-4" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario Final jantar</label>
                                                    <input type="time" id="config_end_dinner" name="config_end_dinner"  value="{{date('H:i', strtotime($config->config_end_dinner))}}" placeholder=".col-8" class="form-control">
                                                </div>
                                            </div>
                                           
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" onclick="createConfig()"class="btn btn-primary btn-sm">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                       
                    </div>
                </div>
    </div>
@endsection

@push('scripts')
<script>
    function createConfig(){
        $.ajax({
        url : "/refectory_config/store",
        type : 'post',
        data : $("#form-create-config").serialize(),
        beforeSend : function(){
            // chamar loading.
        }
        })
        .done(function(msg){
        // chamar função de acerto.
        successmsg("Configurações atualizada com sucesso!!!");
        })
        .fail(function(jqXHR, textStatus, msg){
        // chamar função de erro
        errormsg(jqXHR.responseJSON.message);
        });
    }
</script>
@endpush