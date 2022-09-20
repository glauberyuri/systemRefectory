@extends('layouts.layout')
@push('css')
@endpush
@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="col-lg-12">
                            <div class="card">
                                    <div class="card-header">
                                        Configurações do sistema
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="form-config" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                    <div class="col-4">
                                                        <label for="cc-payment" class="control-label mb-1"> Valor da refeição</label>
                                                        <input type="text" placeholder=".col-6" class="form-control">
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-6">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario inicial almoco</label>
                                                    <input type="text" placeholder=".col-4" class="form-control">
                                                </div>
                                                <div class="col-6">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario Final almoco</label>
                                                    <input type="text" placeholder=".col-8" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                            <div class="col-6">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario inicial janta</label>
                                                    <input type="text" placeholder=".col-4" class="form-control">
                                                </div>
                                                <div class="col-6">
                                                    <label for="cc-payment" class="control-label mb-1"> Horario final janta</label>
                                                    <input type="text" placeholder=".col-8" class="form-control">
                                                </div>
                                            </div>
                                           
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                       
                    </div>
                </div>
    </div>
@endsection

@push('scripts')

@endpush