@extends('layouts.layout')
@push('css')
@endpush
@section('title')
Setores
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
                    <h5 class="title-5">Configurações dos setores</h5>
                        <button type="button"  class="au-btn au-btn-icon au-btn--blue" onclick="openModalCreateSector()">
                            <i class="zmdi zmdi-plus"></i>Cadastrar
                        </button>
                </div>
          </div>
            <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2">Setores</h3>
              </div>
              <hr>
              <table id="list-sectors" class="table">
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


<!-- Modal cadastrar setores -->
<div id="modal-create-sector" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Cadastrar Setor
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                 <form id="form-modal-create-sector"  novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mr-auto ml-auto">
                                <div class="card-body text-secondary">
                                    <label for="x_card_code" class="control-label mb-1">Descrição</label>
                                        <div class="input-group">
                                            <input id="sector_description" name="sector_description" type="text" class="form-control cc-cvc">
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="createSector()" class="btn btn-lg btn-info btn-block">
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
<div id="modal-edit-sector" class="modal fade" tabindex="-1"
    aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="info-header-modalLabel">Cadastrar tipo
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-modal-edit-sector" novalidate="novalidate">
              @csrf
                <div class="modal-body">
                <input type="hidden" id="modal-edit-sector-id_sector">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mr-auto ml-auto">
                                <div class="card-body text-secondary">
                                    <label for="x_card_code" class="control-label mb-1">Descrição</label>
                                        <div class="input-group">
                                            <input id="model-sector_description" name="sector_description" type="text" class="form-control cc-cvc">
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                        <button id="payment-button" type="button" onclick="updateSector()" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-wrench"></i>&nbsp;
                            <span id="payment-button-amount">Editar</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal deletar funcionario -->
<div id="modal-delete-sector" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          @csrf
            <input type="hidden" id="modal-delete-sector-id">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel" style="color:white;">Deletar esse setor
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
                <button type="button" onclick="deleteSector()" class="btn btn-danger font-medium">SIM</button>
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
            listSectors();
        });

        function listSectors(){
          $('#list-sectors').DataTable( {
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
                url: "{{route('sectors.list')}}",
                dataSrc: 'data'
              },
              columns: [
                    { data: 'id_sector'}, 
                    { data: 'sector_description'},
                    { data: null, render: function(data, idx, tp){
                        return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                                +'<a href="javascript:void(0)"  onclick="editSector('+data.id_sector+')" class="text-primary edit">'
                                    +'<i class="fa fa-edit"></i>'
                                +'</a>'
                                +'<a href="javascript:void(0)" onclick="openModalDeleteSector('+data.id_sector+')" class="text-danger delete ms-2">'
                                    +'<i class="fa fa-ban"></i>'
                                +'</a>'
                                +'</div>';
                    }},
              ]
          });
        }

        function openModalDeleteSector(id_sector){
          $("#modal-delete-sector").modal('show');
          $("#modal-delete-sector-id").val(id_sector);
        }

        function deleteSector(){

          var id_sector = $("#modal-delete-sector-id").val();
            
          $.ajax({
            url : "sectors/sectors_delete/"+id_sector,
            type : 'delete',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){

            successmsg("Setor deletado com sucesso");

            $('#list-sectors').DataTable().destroy()

            $("#modal-delete-sector").modal('hide');

            setTimeout(() => {
                listSectors();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel apagar esse setor");
          });
        }

        function editSector(id_sector){
          $.ajax({
            url : "/sectors/sectors_edit/"+id_sector,
            type : 'get',
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(data){

                $("#model-sector_description").val(data.sector_description);
                $("#modal-edit-sector-id_sector").val(data.id_sector);
                $("#modal-edit-sector").modal('show');
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Ocorreu um erro!!");
          });
        
        }

        function updateSector(){

          var id_sector = $("#modal-edit-sector-id_sector").val();

          $.ajax({
            url : "/sectors/sectors_edit_update/"+id_sector,
            type : 'put',
            data : $("#form-modal-edit-sector").serialize(),
            beforeSend : function(){
              // chamar loading.
              location.reload(true);
            }
          })

          .done(function(msg){

            successmsg("Setor editado com sucesso");
            $('#list-sectors').DataTable().destroy()
            $("#modal-edit-sector").modal('hide');
            setTimeout(() => {
                listSectors();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel editar o setor");
          });
        }


        function openModalCreateSector(){
            $('#modal-create-sector').modal('show');
        }


        function createSector(){

            $.ajax({
            url : "/sectors/store",
            type : 'post',
            data : $("#form-modal-create-sector").serialize(),
            beforeSend : function(){
                // chamar loading.
            }
            })

            .done(function(msg){
            $('#list-sectors').DataTable().destroy()
            $("#modal-create-sector").modal('hide');
            location.reload(true);
            
            setTimeout(() => {
                listSectors();
            }, 500);
            // chamar função de acerto.
            successmsg("Setor criado com sucesso!!!");
            })
            .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel criar um setor");

            });
        }
    </script>

@endpush
