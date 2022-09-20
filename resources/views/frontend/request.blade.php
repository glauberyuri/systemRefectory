@extends('layouts.auth.layout')

@section('content')

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/logo-hospital.png" alt="HCMR">
                            </a>
                        </div>
                        <div class="login-form">
                            <form>
                            @csrf
                                <div class="form-group">
                                    <label>Reserva de Refeições</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="request_code" name="request_code" placeholder="Matricula" class="form-control">
                                    </div>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="button" class="btn btn-secondary mb-1" onclick="openModalRequest()">Solicitar</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Cancelar pedido?
                                    <a href="#">clique aqui</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- modal Request -->
    <div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Solicitar Refeição</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="card">
                            <div class="card-header">
                                <strong>Prezado usuário</strong>   
                                <p>
                                        Para realizar suas refeições no Restaurante Hosital das Clinicas Mario Ribeiro
                                        é necessário que você confirme seus dados e o valor da refeição e faça a reserva das
                                        refeições que você for consumir.
                                </p>
                            </div>
                            <div class="card-body">
                                <form class="form" method="post" action="{{ route('refectory_request.store') }}" >
                                    @csrf
                                        <input type="hidden" id="model-request-status" name="model-request-status" value="1">
                                        <input type="hidden" id="model-request-value" name="model-request-value" value="5">
                                        <input type="hidden" id="model-request-date" name="model-request-date" value="{{ date('Y-m-d H:i:s') }}">
                                        <input type="hidden" id="model-request-id_employee" name="model-request-id_employee">
                                           
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="exampleInputName2" class="pr-1  form-control-label">Nome</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="model-request-name" name="model-request-name"  required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="exampleInputEmail2" class="px-1  form-control-label">Setor</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="model-request-sector"  name="model-request-sector" required="" class="form-control">
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Refeição</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="type_select" id="type_select" class="form-control">
                                                        <option value="0">Selecione</option>
                                                        @foreach($types as $type)
                                                            <option value="{{$type->id_type}}">{{$type->type_description}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                            <strong>Valor : R$ 5,00</strong>   
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Solictar</button>
                            </div>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
@endsection
@push('scripts')
    <script>
        
        function openModalRequest(){
          let request_code = $("#request_code").val();

          $.ajax({
            url : "/refectory_employee/showModel/"+request_code,
            type : 'get',
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(data){
            if(data.employee_name && data.employee_sector){
                $("#model-request-name").val(data.employee_name);
                $("#model-request-sector").val(data.employee_sector);
                $("#model-request-code").val(request_code);
                $("#model-request-id_employee").val(data.id_employee);
                $("#modal-request").modal('show');
            }else{
                alert("Dados não encontrados com essa matrícula "+ request_code);
            }
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Ocorreu um erro!!");
          });
        }

    </script>

@endpush

