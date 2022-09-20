@extends('layouts.layout')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                        <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Novo Funcionarios</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Cadastro</h3>
                                        </div>
                                        <hr>
                                        <form  method="POST" action="{{ route('refectory_employee.store') }}" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Nome Completo</label>
                                                <input id="employee_name" name="employee_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Setor</label>
                                                <input id="employee_sector" name="employee_sector" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Numero</label>
                                                <input id="employee_number" name="employee_number" type="number" class="form-control" aria-required="true" aria-invalid="false" value="">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Horario</label>
                                                        <input id="employee_time" name="employee_time" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Matricula</label>
                                                    <div class="input-group">
                                                        <input id="employee_code" name="employee_code" type="tel" class="form-control cc-cvc" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('scripts')

