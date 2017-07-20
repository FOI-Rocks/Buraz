@extends('master.empty')

@section('header') Login - Veliki Buraz @endsection

@section('bodyStyle') background-color: #F1654C; color: #fff; @endsection

@section('content')
<div class="container" style="padding-top: 150px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1 style="font-size: 48px;">Veliki Buraz - Prijava</h1>
            <p style="font-size: 20px;">Student/ica si više godine i želiš pomoći ukoliko te netko zatreba? Ovo je pravo mjesto za tebe!
            </p>
            <p style="font-size: 20px;">Prijava je jednostavna, samo pritisni gumb ispod kako bi se prijavio/la putem facebooka te prati upute.</p>
            <br><br>
            <a href="{{ route('mentor.login.go') }}">
                <img src="{{ asset('img/fb-login.png') }}">
            </a>
        </div>
    </div>
</div>
@endsection