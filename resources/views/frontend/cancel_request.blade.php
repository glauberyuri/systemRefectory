@extends('layouts.auth.layout')
@section('title')
Cancelar Solicitação
@endsection
@section('content')

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{url ('images/icon/logo-hospital.png')}}" alt="HCMR">
                            </a>
                        </div>
                        <div class="login-form">
                                <form class="form" method="post" action="{{ route('refectory_request.cancelRequest') }}" >
                                    @csrf
                                    <div class="form-group">
                                        <label>Cancelar sua Refeição</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="request_code" name="request_code" placeholder="Matricula" class="form-control">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-mb-1" type="submit" >Cancelar</button>
                                <div class="register-link">
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

