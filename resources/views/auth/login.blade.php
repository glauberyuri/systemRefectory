@extends('layouts.auth.layout')
@section('title')
Login
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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" hidden>
                                    </label>
                                    <label>
                                        <a href="#">Esqueceu a senha ?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">{{ __('Login') }}</button>
                            </form>
                            @if(session('msg'))
                                    <div class="alert alert-danger" role="alert">
                                        <p>{{ session('msg') }}</p>
                                    </div>
                                @endif
                            <div class="register-link">
                                <p>
                                    Primeiro acesso?
                                    <a href="#">clique aqui</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
