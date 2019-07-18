@extends('master.empty')

@section('header') Login - Mali Buraz @endsection

@section('bodyStyle') background-color: #26A65B; color: #fff; @endsection

@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v3.3&appId=1637256469877794&autoLogAppEvents=1"></script>
<div class="container" style="padding-top: 150px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1 style="font-size: 48px;">Mali Buraz - Prijava</h1>
            <p style="font-size: 20px;">Brucoš/ica si? Iskoristi ovu priliku i pronađi si "velikog buraza" kojeg uvijek možeš kontaktirati ako budeš imao/la nekih nejasnoća u vezi studiranja, profesora ili čak samog života u Varaždinu.
            </p>
            <p style="font-size: 20px;">Prijava je jednostavna, samo pritisni gumb ispod kako bi se prijavio/la putem Facebooka te prati upute.</p>
            <br><br>
            <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="true"></div>
        </div>
    </div>
</div>
@endsection