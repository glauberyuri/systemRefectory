@extends('layouts.layout')
@push('css')
@endpush
@section('title')
  Relatório Mensal de solicitações
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
                  <h3 class="text-center title-2">Solicitações</h3>
              </div>
              <hr>
              <table id="list-request" class="table">
                  <thead class="thead-dark">
                      <tr>
                      <th scope="col">Matricula</th>
                      <th scope="col">Solicitante</th>
                      <th scope="col">Setor</th>
                      <th scope="col">Quantidade</th>
                      <th scope="col">Valor</th>
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
                url: "{{route('refectory_request.list')}}",
                dataSrc: 'data'
              },
              columns: [
                  { data: 'employee_code'},
                  { data: 'employee_name'},
                  { data: 'employee_sector' },
                  { data: 'request_qty'},
                  { data: 'request_value_total'},
                 
              ]
          });
        }

    </script>

@endpush
