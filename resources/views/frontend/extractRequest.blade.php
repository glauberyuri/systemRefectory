@extends('layouts.auth.layout')
@section('title')
Extrato
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
                                <form class="form" method="post" action="{{route('refectory_reports.employeeReportsPDF') }}" >
                                    @csrf
                                    <div class="form-group">
                                        <label>Adquirir meu Extrato</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="request_code" name="request_code" placeholder="Matricula" class="form-control">
                                        </div>
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" >Extrato</button>
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

