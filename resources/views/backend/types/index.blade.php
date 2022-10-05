@extends('layouts.layout')
@push('css')
@endpush
@section('content')
  <!-- Column -->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
                <div class="overview-wrap">
                    <h5 class="title-5">Configurações dos tipos</h5>
                        <button type="button"  class="au-btn au-btn-icon au-btn--blue" onclick="openModalCreateType()">
                            <i class="zmdi zmdi-plus"></i>Cadastrar
                        </button>
                </div>
          </div>
            <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2">Tipos</h3>
              </div>
              <hr>
              <table id="list-types" class="table">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descrição</th>
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


<!-- Modal cadastrar tipos -->
<div id="modal-create-types" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Cadastrar tipo
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                 <form id="form-modal-create-types" method="POST" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mr-auto ml-auto">
                                <div class="card-body text-secondary">
                                    <label for="x_card_code" class="control-label mb-1">Descrição</label>
                                        <div class="input-group">
                                            <input id="type_description" name="type_description" type="text" class="form-control cc-cvc">
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="createType()" class="btn btn-lg btn-info btn-block">
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

<!-- Modal editar tipos -->
<div id="modal-edit-types" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Cadastrar tipo
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <input type="hidden" id="modal-edit-types-id_type">
                 <form id="form-modal-edit-types" method="POST" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mr-auto ml-auto">
                                <div class="card-body text-secondary">
                                    <label for="x_card_code" class="control-label mb-1">Descrição</label>
                                        <div class="input-group">
                                            <input id="model-type_description" name="type_description" type="text" class="form-control cc-cvc">
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="updateTypes()" class="btn btn-lg btn-info btn-block">
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
<div id="modal-delete-type" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-delete-type-id">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Deletar tipo
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
                <button type="button" onclick="deleteType()" class="btn btn-danger font-medium">SIM</button>
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
            listTypes();
        });

        function listTypes(){
          $('#list-types').DataTable( {
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
                url: "{{route('types.list')}}",
                dataSrc: 'data'
              },
              columns: [
                    { data: 'id_type'}, 
                    { data: 'type_description'},
                    { data: null, render: function(data, idx, tp){
                        return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                                +'<a href="javascript:void(0)"  onclick="editType('+data.id_type+')" class="text-primary edit">'
                                    +'<i class="fa fa-edit"></i>'
                                +'</a>'
                                +'<a href="javascript:void(0)" onclick="openModalDeleteType('+data.id_type+')" class="text-danger delete ms-2">'
                                    +'<i class="fa fa-ban"></i>'
                                +'</a>'
                                +'</div>';
                    }},
              ]
          });
        }

        function openModalDeleteType(id_type){
          $("#modal-delete-type").modal('show');
          $("#modal-delete-type-id").val(id_type);
        }

        function deleteType(){

          var id_type = $("#modal-delete-type-id").val();
            
          $.ajax({
            url : "types/types_delete/"+id_type,
            type : 'delete',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){

            successmsg("Tipo deletado com sucesso");

            $('#list-types').DataTable().destroy()

            $("#modal-delete-type").modal('hide');

            setTimeout(() => {
                listTypes();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel cancelar esse tipo");
          });
        }

        function editType(id_type){
          $.ajax({
            url : "/types/types_edit/"+id_type,
            type : 'get',
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(data){

                $("#model-type_description").val(data.type_description);
                $("#modal-edit-types-id_type").val(data.id_type);
                $("#modal-edit-types").modal('show');
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Ocorreu um erro!!");
          });
        
        }

        function updateTypes(){

          var id_type = $("#modal-edit-types-id_type").val();

          $.ajax({
            url : "/types/types_edit_update/"+id_type,
            type : 'put',
            data :$("#form-modal-edit-types").serialize(),
            beforeSend : function(){
              // chamar loading.
            }
          })

          .done(function(msg){

            successmsg("Tipo editado com sucesso");
            $('#list-types').DataTable().destroy()
            $("#modal-edit-types").modal('hide');
            setTimeout(() => {
                listTypes();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel editar o tipo");
          });
        }


        function openModalCreateType(){
            $('#modal-create-types').modal('show');
        }


        function createType(){

            $.ajax({
            url : "/types/store",
            type : 'post',
            data : $("#form-modal-create-types").serialize(),
            beforeSend : function(){
                // chamar loading.
            }
            })

            .done(function(msg){

            $('#list-types').DataTable().destroy()
            $("#modal-create-types").modal('hide');
            
            setTimeout(() => {
                listTypes();
            }, 500);
            // chamar função de acerto.
            successmsg("Tipo criado com sucesso!!!");
            })
            .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel criar um tipo");

            });
        }
    </script>

@endpush
