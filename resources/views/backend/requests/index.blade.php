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
          <div class="card-header">Solicitações dos Funcionarios</div>
            <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2">Solicitações</h3>
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
@endsection

@push('scripts')
    <script>
        $(function(){
            listRequestDay();
        });

        function listRequestDay(){
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
                url: "{{route('refectory_request.list')}}",
                dataSrc: 'data'
              },
              columns: [
                  { data: 'employee_code'},
                  { data: 'employee_name'},
                  { data: 'employee_sector' },
                  { data: 'id_status'},
                  { data: 'type_description'},
                  { data: null, render: function(data, idx, tp){
                    return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                              +'<a href="/refectory_request/'+data.id_request+'/approve" class="text-primary edit">'
                                +'<i class="fa fa-check"></i>'
                              +'</a>'
                              +'<a href="javascript:void(0)" onclick="openModalDeleteRequest('+data.id_request+')" class="text-danger delete ms-2">'
                                +'<i class="fa fa-ban"></i>'
                              +'</a>'
                            +'</div>';
                  }},
              ]
          });
        }

        function openModalDeleteRequest(id_request_product){
          $("#modal-delete-request_product").modal('show');
          $("#modal-delete-request-product-id_request_product").val(id_request_product);
        }

        function deleteRequest(){
          var id = $("#modal-delete-request-product-id_request_product").val();
          $.ajax({
            url : "/stock_request/"+ id,
            type : 'delete',
            data : {'_token': "{{csrf_token()}}"},
            beforeSend : function(){
              // chamar loading.
            }
          })
          .done(function(msg){
            $('#list-request-product').DataTable().destroy()
            $("#modal-delete-request_product").modal('hide');
            setTimeout(() => {
                listRequestProduct();
            }, 500);
           
          })
          .fail(function(jqXHR, textStatus, msg){
            // chamar função de erro
            errormsg("Não foi possivel cancelar a solicitação");
          });
        }
    </script>

@endpush
