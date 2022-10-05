@extends('layouts.layout')
@push('css')
@endpush
@section('title')
Usuarios
@endsection
@section('content')
  <!-- Column -->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
                <div class="overview-wrap">
                    <h5 class="title-5">Configurações dos Usuarios</h5>
                        <a href="{{route('register')}}" class="btn btn-primary">Cadastrar</a>
                </div>
          </div>
            <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2">Usuarios</h3>
              </div>
              <hr>
              <table id="list-users" class="table">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
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


<!-- Modal deletar funcionario -->
<div id="modal-delete-user" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-delete-user-id">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Deletar usuario
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
                <button type="button" onclick="deleteUser()" class="btn btn-danger font-medium">SIM</button>
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
            listUsers();
        });

        function listUsers(){
          $('#list-users').DataTable( {
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
                url: "{{route('users_list.list')}}",
                dataSrc: 'data'
              },
              columns: [
                  { data: 'name'},
                  { data: 'email'},
                  { data: null, render: function(data, idx, tp){
                    return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                              +'<a href="javascript:void(0)" onclick="openModalDeleteUser('+data.id+')" class="text-danger delete ms-2">'
                                +'<i class="fa fa-ban"></i>'
                              +'</a>'
                            +'</div>';
                  }},
              ]
          });
        }

        function openModalDeleteUser(id){
          $("#modal-delete-user").modal('show');
          $("#modal-delete-user-id").val(id);
        }

        function deleteUser(){
          var id = $("#modal-delete-user-id").val();
          $.ajax({
            url : "users/users_delete/"+ id,
            type : 'delete',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){

            successmsg("Usuario deletado com sucesso");

            $('#list-users').DataTable().destroy()

            $("#modal-delete-user").modal('hide');
            setTimeout(() => {
                listUsers();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel cancelar a solicitação");
          });
        }
    </script>

@endpush
