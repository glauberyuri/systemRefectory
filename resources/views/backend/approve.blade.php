@extends('layouts.layout')

@section('content')
<body class="animsition">
  <div class="page-wrapper">
      <div class="page-content--bge5">
          <div class="container">
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12 col-xl-12 col-md-12">
                  <div class="card mx-2">
                    <div class="card-body">
                          <div class="d-flex no-block align-items-center mb-4">
                            <h4 class="card-title">Solicitações</h4>
                          </div>
                            <table id="list-request" class="table table-bordered nowrap display">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Setor</th>
                                    <th>Status</th>
                                    <th>Data solicitação</th>
                                    <th>Ações</th>
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
  <!-- Column -->
  </div>

<!-- Modal delete Tipo de produto -->
<div id="modal-delete-request_product" class="modal fade" tabindex="-1"
    aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-delete-request-product-id_request_product">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel">Deseja rejeitar movimentação ?
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mt-0">Cuidado</h5>
                <p>Realmente deseja seguir com essa ação?.
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

@endsection

@push('scripts')
    <script src="{{url('/js/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('/js/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/js/app.min.js')}}"></script>
    <script src="{{url('/js/app.init.js')}}"></script>
    <script src="{{url('/js/app-style-switcher.js')}}"></script>
    <script src="{{url('/js/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('/js/extra-libs/sparkline/sparkline.js')}}"></script>
    <script src="{{url('/js/waves.js')}}"></script>
    <script src="{{url('/js/sidebarmenu.js')}}"></script>
    <script src="{{url('/js/feather.min.js')}}"></script>
    <script src="{{url('/js/custom.min.js')}}"></script>
    <script src="{{url('/js/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{url('/js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <!-- Toast mensages -->
    <script>
        $(function(){
            listRequestProduct();
        });

        function listRequestProduct(){
          $('#list-request').DataTable( {
              processing: true,
              serverSide: true,
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
                  { data: 'id_requisition' },
                  { data: 'requester'},
                  { data: 'sector' },
                  { data: 'status'},
                  { data: 'date_requested'},
                  { data: null, render: function(data, idx, tp){
                    return '<div  class="action-btn" style="float: right; font-size: 22px;">'
                              +'<a href="/stock_request/'+data.id_stock_requisition+'/approve" class="text-primary edit">'
                                +'<i class="mdi mdi-check-circle"></i>'
                              +'</a>'
                              +'<a href="javascript:void(0)" onclick="openModalDeleteRequest('+data.id_stock_requisition+')" class="text-danger delete ms-2">'
                                +'<i class="mdi mdi-delete"></i>'
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
