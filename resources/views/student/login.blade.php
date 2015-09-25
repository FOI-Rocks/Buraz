@extends('master.empty')

@section('header') Login - Mali Buraz @endsection

@section('bodyStyle') background-color: #26A65B; color: #fff; @endsection

@section('content')
<div class="container" style="padding-top: 150px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1 style="font-size: 48px;">Mali Buraz - Prijava</h1>
            <p style="font-size: 20px;">Brucoš/ica si? Iskoristi ovu priliku i dodjeli si "velikog buraza" kojeg uvijek možeš pitati ukoliko češ imati nekih nejasnoća oko studiranja, profesora ili čak samog života u Varaždinu.
            </p>
            <p style="font-size: 20px;">Prijava je jednostavna, samo pritisni gumb ispod kako bi se prijavio/la putem facebooka te prati upute.</p>
            <br><br>
            <a href="{{ route('student.login.go') }}">
                <img src="{{ asset('img/fb-login.png') }}">
            </a>
        </div>
    </div>
</div>
@endsection