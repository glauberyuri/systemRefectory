@extends('layouts.layout')
@section('title')
  Relatório de solicitações atendidas por funcionário
@endsection
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
                <form class="form-horizontal" id="form_reports_employees" method="post" action="{{route('refectory_reports.employeeReportsPDF')}}" role="form">
                  @csrf
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="form-group col col-md-8">
                                        <label for="start">Nome do Funcionario:</label>
                                        <select 
                                        id="select-id_employee"
                                        name="id_employee"
                                        class="form-control select2"
                                        required
                                        class="form-control select2-single select2-hidden-accessible h-100" tabindex="-1" aria-hidden="true"
                                        data-validation-required-message="Esse campo é obrigatório">
                                        </select>
                                    </div>
                                    <div class="form-group col col-md-4">
                                        <label for="start">Mês:</label>
                                        <input  type="month" id="reports_month" name="reports_month"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"  class="btn btn-primary font-medium">
                                    <i class="fa  fa-search"></i> Procurar
                                </button>
                            </div>
                        </div>
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

     $(function(){
      
      $("#select-id_employee").select2({
        placeholder: 'Selecine um funcionario',
        ajax: {
          url: '{{route("refectory_employee.getEmployees")}}',
          type: 'get',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: $.map(data, function(obj) {
                return { id: obj.id_employee, text: obj.employee_name };
              })
            };
          },
          cache: true
        }
      });
    });



</script>

@endpush
