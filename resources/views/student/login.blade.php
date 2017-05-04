@extends('master.empty')

@section('header') Login - Mali Buraz @endsection

@section('bodyStyle') background-color: #26A65B; color: #fff; @endsection

@section('content')
<div class="container" style="padding-top: 150px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1 style="font-size: 48px;">Mali Buraz - Prijava</h1>
            <p style="font-size: 20px;">Brucoš/ica si? Iskoristi ovu priliku i pronađi si "velikog buraza" kojeg uvijek možeš kontaktirati ako budeš imao/la nekih nejasnoća u vezi studiranja, profesora ili čak samog života u Varaždinu.
            </p>
            <p style="font-size: 20px;">Prijava je jednostavna, samo pritisni gumb ispod kako bi se prijavio/la putem Facebooka te prati upute.</p>
            <br><br>
            <a href="{{ route('student.login.go') }}">
                <img src="{{ asset('img/fb-login.png') }}">
            </a>
        </div>
    </div>
</div>
@endsection