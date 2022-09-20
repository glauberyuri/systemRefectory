@extends('layouts.layout')
@push('css')
@endpush
@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Lista de Funcionarios</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Funcionarios</h3>
                                        </div>
                                        <div class="md-8">
                                            <button type="button"  onclick="openModalCreate()"  class="btn btn-light-info text-info font-weight-medium rounded-pill px-4" href=""> Novo Funcionario </button>
                                        </div>
                                        <hr>
                                        <table id="list-employees" class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">Matricula</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Setor</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                       
                    </div>
                </div>
    </div>


<!-- /.modal -->

<!-- Modal cadastrar funcionario -->
<div id="modal-create-employee" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Cadastrar Funcionario
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                 <form id="form-modal-create-employee" method="POST" novalidate="novalidate">
                    @csrf
                    <input type="hidden" id="id_status" name="id_status">
                    <div class="row">
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Matricula</label>
                            <div class="input-group">
                                <input id="employee_code" name="employee_code" type="tel" class="form-control cc-cvc" value="">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nome Completo</label>
                                <input id="employee_name" name="employee_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Setor</label>
                                <input id="employee_sector" name="employee_sector" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Matricula</label>
                            <div class="input-group">
                                <input id="employee_code" name="employee_code" type="tel" class="form-control cc-cvc" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="cc-name" class="control-label mb-1">Email</label>
                        <input id="employee_email" name="employee_email" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cc-number"  class="control-label mb-1">Status</label>
                            <div class="form-group">
                            <label class="switch switch-default switch-success mr-2">
                                <input type="checkbox" name="id_status"  class="switch-input" checked="true">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="cc-number"  class="control-label mb-1">Médico?</label>
                            <div class="form-group">
                            <label class="switch switch-default switch-success mr-2">
                                <input type="checkbox" name="id_status"  class="switch-input" checked="true">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="createEmployee()" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-plus-square"></i>&nbsp;
                            <span id="payment-button-amount">Cadastrar</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal edit stock -->
<div id="modal-edit-employee" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-edit-employee-id_employee">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Editar Funcionario
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <form id="form-modal-edit-employee" method="POST"  novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nome Completo</label>
                        <input id="model-employee_name" name="employee_name"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Setor</label>
                                <input id="model-employee_sector" name="employee_sector"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Matricula</label>
                            <div class="input-group">
                                <input id="model-employee_code" name="employee_code"  type="tel" class="form-control cc-cvc" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="cc-name" class="control-label mb-1">Email</label>
                        <input id="model-employee_email" name="employee_email"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cc-number" class="control-label mb-1">Status</label>
                            <div class="form-group">
                            <label class="switch switch-default switch-success mr-2">
                                <input type="checkbox" id="model-employee_id_status" name="id_status"  class="switch-input" checked="true">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Telefone</label>
                                <input id="model-employee_number" name="employee_number" type="number" class="form-control" aria-required="true" aria-invalid="false" value="">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="editEmployee()" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-plus-square"></i>&nbsp;
                                        <span id="payment-button-amount">Cadastrar</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal deletar funcionario -->
<div id="modal-delete-employee" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-delete-employee-id_employee">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Deletar funcionario
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mt-0">Cuidado </h5>
                <p>Realmente deseja seguir com essa ação?.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-secondary btn-light-secondary"
                    data-bs-dismiss="modal">VOLTAR</button>
                <button type="button" onclick="deleteEmployee()" class="btn btn-danger font-medium">SIM</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@push('scripts')
<script>
        $(function(){
            listEmployees();
        });

        function listEmployees(){
          $('#list-employees').DataTable( {
              processing: true,
              //serverSide: true,
              autoWidth: true,
              "dom": '<"pull-right"f><"pull-left"l>tip',
              "language": {
                    "lengthMenu": "Exibindo _MENU_ registros por página",
                    "zeroRecords": "Nenhum registro",
                    "info": "Exibindo a página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro",
                    "infoFiltered": "(Exibindo _MAX_ resultados)",
                    "sSearch":       	"Pesquisar",
                    "oPaginate": {
                        "sFirst":    	"Primeira",
                        "sPrevious": 	"<",
                        "sNext":     	">",
                        "sLast":     	"Ultima"
                    },
              },
              ajax: {
                url: "{{route('refectory_employee.list')}}",
                dataSrc: 'data'
              },
              columns: [
                  { data: 'employee_code' },
                  { data: 'employee_name' },
                  { data: 'employee_sector' },
                  { data: 'employee_status', render: function(data){
                    return (data == 0 ? "Inativo" : "Ativo");
                  }},
                  { data: null, render: function(data, idx, tp){
                    return '<div class="action-btn" style="float: right; font-size: 22px;">'
                              +'<a href="javascript:void(0)" onclick="editEmployee('+data.id_employee+')" class="text-primary edit">'
                                +'<i class="fa fa-edit"></i>'
                              +'</a>'
                              +'<a href="javascript:void(0)" onclick="openModalDeleteEmployee('+data.id_employee+')" class="text-danger delete ms-2">'
                                +'<i class="fa fa-ban"></i>'
                              +'</a>'
                            +'</div>';
                  }},
              ]
          });
        }

        function openModalCreate(){
            $('#modal-create-employee').modal('show');
        }

        
        function openModalDeleteEmployee(id_employee){
          $("#modal-delete-employee").modal('show');
          $("#modal-delete-employee-id_employee").val(id_employee);
        }

        function deleteEmployee(){

          var id_employee = $("#modal-delete-employee-id_employee").val();
            console.log(id_employee);
          $.ajax({
            url : "/refectory_employee/employee_delete/"+id_employee,
            type : 'delete',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })

          .done(function(msg){

            successmsg("Funcionario deletado com sucesso");
            $('#list-employees').DataTable().destroy()
            $("#modal-delete-employee").modal('hide');
            setTimeout(() => {
                listEmployees();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel deletar a solicitação");
          });
        }

        function editEmployee(id_employee){
          $.ajax({
            url : "/refectory_employee/employee_edit/"+id_employee,
            type : 'get',
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(data){
            if(data.employee_name && data.employee_sector){
                $("#model-employee_name").val(data.employee_name);
                $("#model-employee_sector").val(data.employee_sector);
                $("#model-employee_code").val(data.employee_code);
                $("#modal-edit-employee-id_employee").val(data.id_employee);
                $("#model-employee_email").val(data.employee_email);
                $("#model-employee_number").val(data.employee_number);
                $("#model-employee_id_status").val(data.id_status);
                $("#modal-edit-employee").modal('show');
            }else{
                alert("Dados não encontrados com essa matrícula "+ id_employee);
            }
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Ocorreu um erro!!");
          });
        
        }

        function updateEmployee(){

          var id_employee = $("#modal-edit-employee-id_employee").val();
            console.log(id_employee);
          $.ajax({
            url : "/refectory_employee/employee_edit/"+id_employee,
            type : 'put',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })

          .done(function(msg){

            successmsg("Funcionario editado com sucesso");
            $('#list-employees').DataTable().destroy()
            $("#modal-edit-employee").modal('hide');
            setTimeout(() => {
                listEmployees();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel editar a solicitação");
          });
        }

        function createEmployee(){
        $.ajax({
        url : "/refectory_employee/store",
        type : 'post',
        data : $("#form-modal-create-employee").serialize(),
        beforeSend : function(){
            // chamar loading.
        }
        })
        .done(function(msg){
        $('#list-employees').DataTable().destroy()
        $("#modal-create-employee").modal('hide');
        setTimeout(() => {
            listEmployees();
        }, 500);
        // chamar função de acerto.
        successmsg("Funcionario atualizado com sucesso!!!");
        })
        .fail(function(jqXHR, textStatus, msg){
        // chamar função de erro
        errormsg("Não foi possivel criar o funcionario");
        });
        }



    </script>
@endpush