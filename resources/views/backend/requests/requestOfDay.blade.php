@extends('layouts.layout')
@push('css')
@endpush
@section('title')
  Solicitações diaria
@endsection
@section('content')
  <!-- Column -->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">Solicitações dos Funcionarios</div>
            <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2">Solicitações do Dia</h3>
              </div>
              <hr>
              <table id="list-request" class="table">
                  <thead class="thead-dark">
                      <tr>
                      <th scope="col">Matricula</th>
                      <th scope="col">Solicitante</th>
                      <th scope="col">Setor</th>
                      <th scope="col">Status</th>
                      <th scope="col">Tipo</th>
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
<!-- Modal Cancelar Requisição -->
<div id="modal-approve-request" class="modal fade" tabindex="-1"
    aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-approve-request-id_request">
            <div class="modal-header modal-colored-header bg-success text-white">
                <h4 class="modal-title" id="success-header-modalLabel" style="color:white;">Aprovado
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mt-0"></h5>
                <p>Refeição entregue com sucesso.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-primary btn-light-secondary"
                    data-bs-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Cancelar Requisição -->
<div id="modal-delete-request" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-delete-request-id_request">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Cancelar requisição
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mt-0">Atenção! </h5>
                <p>Você esta prestes a informar o descate de uma refeição, essa ação é irreversível e o valor será cobrado do solicitante!
                </p>
                <p>
                  Deseja prosseguir com a ação?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-secondary btn-light-secondary"
                    data-bs-dismiss="modal">VOLTAR</button>
                <button type="button" onclick="deleteRequest()" class="btn btn-danger font-medium">SIM</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Transferir Requisição -->
<div id="modal-transfer-request" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <div class="modal-header modal-colored-header bg-primary text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Transferir refeição
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                          <i class="fa fa-user"></i>
                          <strong class="card-title pl-2">Dados do novo funcionario</strong>
                      </div>
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 s">
                                <input type="hidden" id="id_employee">
                                <input type="hidden" id="id_request">
                                <input type="text" id="employee_code" name="request_code" onkeyup="findEmployee()" placeholder="Matricula" class="form-control">
                                <div class="card-body text-secondary"></div>
                            </div>
                            <div class="col-md-8 s">
                              <div class="location text-sm-center">
                                <input type="text" id="label-name"  placeholder="Nome do colaborador" class="form-control" disabled>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn text-secondary btn-light-secondary"
                    data-bs-dismiss="modal">VOLTAR</button>
                <button type="button" onclick="Transfer()" class="btn btn-primary font-medium">Transferir</button>
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
            listRequest();
        });

        function listRequest(){
          $('#list-request').DataTable( {
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
                url: "{{route('refectory_request.listRequestDay')}}",
                dataSrc: 'data'
              },
              columns: [
                  { data: 'employee_code'},
                  { data: 'employee_name'},
                  { data: 'employee_sector' },
                  { data: 'request_status', render: function(data, idx, tp){
                    if(data == 1){
                      return '<span class="badge badge-primary">Solicitado</span>'
                    }if(data == 2){
                      return '<span class="badge badge-success">Entregue</span>'
                    } if(data == 3){
                      return '<span class="badge badge-danger">Descartado</span>'
                    }
                    if(data == 4){
                      return '<span class="badge badge-primary">Transferido</span>'
                    }
                  }},
                  { data: 'type_description'},
                  { data: null, render: function(data, idx, tp){
                    
                    if(data.request_status == 1){
                    return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                              +'<a href="javascript:void(0)" onclick="ApproveRequest('+data.id_request+')" class="text-success edit">'
                                +'<i class="fa fa-check"></i> '
                              +'</a>'
                              +'<a href="javascript:void(0)" onclick="openModalTransferRequest('+data.id_request+')" class="text-primary delete ms-2">'
                                +'<i class="fas fa-exchange-alt"></i> '
                              +'</a>'
                              +'<a href="javascript:void(0)" onclick="openModalDeleteRequest('+data.id_request+')" class="text-danger delete ms-2">'
                                +'<i class="fa fa-ban"></i>'
                              +'</a>'
                              
                            +'</div>';
                    }else{
                      return null;
                    }
                  }},
              ]
          });
        }

        function openModalDeleteRequest(id_request){
          $("#modal-delete-request").modal('show');
          $("#modal-delete-request-id_request").val(id_request);
        }

        function openModalTransferRequest(id_request){
          $("#modal-transfer-request").modal('show');
          $("#id_request").val(id_request);
        }

        function findEmployee(){


          $.ajax({
            url : "{{route('refectory_employee.findEmployee')}}",
            type : 'get',
            data : {'_token': "{{csrf_token()}}", 'id_employee': $('#employee_code').val()},
            beforeSend : function(){
              // chamar loading.
            }
          })

          .done(function(data){

            $("#label-name").val(data.employee_name);
            $("#id_employee").val(data.id_employee);
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro 
            errormsg();
          });
        }
        

        function deleteRequest(){
          
          var id_request = $("#modal-delete-request-id_request").val();
          $.ajax({
            url : "/refectory_request/request_status_delete/"+id_request,
            type : 'put',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){
              // chamar função de acerto.
              successmsg("Refeição cancelada com sucesso!!!");

              $('#list-request').DataTable().destroy()
              $("#modal-delete-request").modal('hide'); 
                setTimeout(() => {
                  listRequest();
                }, 500);
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro 
            errormsg();
          });
        }

        function ApproveRequest(id_request){
          $.ajax({
            url : "/refectory_request/request_status_approve/"+id_request,
            type : 'put',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){
            $('#list-request').DataTable().destroy();
            successmsg("Refeição entregue com sucesso!!!");
            setTimeout(() => {
              listRequest();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg();
          });
        }

        function Transfer(){

          $.ajax({
            url : "/refectory_request/transfer",
            type : 'post',
            data : {'_token': "{{csrf_token()}}",'id_employee': $('#id_employee').val(),'id_request': $('#id_request').val()},
            beforeSend : function(){
                // chamar loading.
            }
            })
            .done(function(msg){
              $('#list-request').DataTable().destroy()
            $("#modal-transfer-request").modal('hide');
            
            setTimeout(() => {
                listRequest();
            }, 500);
            // chamar função de acerto.
            successmsg("Refeição trasnferida com sucesso!!!");
            })
            .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel transferir a refeição");
            });
          }
    </script>

@endpush
