@extends('master.master')

@section('header') Naslovna @endsection

@section('content')
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">
                        FOI <img style="height: 95px; widht: auto; margin-top: -20px;" src="{{ asset("img/logo.png") }}">
                        </h1>
                        <p class="intro-text">
                            <b>Neslužbeni projekt studentskog mentorstva brucošima/cama</b>
                            <br>
                            Dodijeli si svog "velikog buraza" i on će biti uz tebe s informacijama iz prve ruke, kad i ako ti to zatreba.
                        </p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>O BURAZ PROJEKTU</h2>
                <p>
                    Ovo je neslužbeni projekt kojim spajamo dobrovoljce studente/ice starijih godina (tzv. velike buraze) koji žele podijeliti svoje savjete i iskustva iz prve ruke brucošima/cama (tzv. malim burazima).
                </p>
                <p>
                    Princip je vrlo jednostavan, stariji studenti/ce koji žele sudjelovati nasumično se dodijele svakom brucošu/ici koji zatraži svog buraza. Mali buraz tada dobije kontakt informacije (Facebook ime, e-mail, telefon) svog mentora kojem se može, ali i ne mora javiti. Svakako preporučamo da se javite svom velikom burazu kad vam se dodijeli, no to nije obavezno, on vam može biti u pripravnosti ako ga ikad zatreba.
                </p>
                <p>
                    <b>Kako vam veliki buraz može pomoći?</b>
                    <br>
                    Prva godina fakulteta je svima zbunjujući trenutak u životu, preplavljeni ste informacijama, ne znate kako taj cijeli sustav funkcionira i ne poznajete profesore. Tu uskače vaš veliki buraz - ako vam nije jasno nešto o principu studiranja, ECTS-a, kolokvija, ispita ili pak trebate savjet koji kolegij upisati a koji ne, pitajte! Vašem burazu neće biti problem odvojiti 2 minute svog vremena da vam odgovori na pitanje. Koliko god glupo se vama činilo, svi smo imali taj problem u jednom trenutku. :)
                </p>
            </div>
        </div>
        <div class="row">
            <h3>Trenutno registrirano:</h3>
            <div class="col-lg-4 col-lg-offset-2" style="color: #000; font-size: 26px;">
                <div class="well well-lg">
                    <b>Veliki Burazi</b>
                    <br>
                    {{ $mentorNum }}
                </div>
            </div>
            <div class="col-lg-4" style="color: #000; font-size: 26px;">
                <div class="well well-lg">
                    <b>Mali Burazi</b>
                    <br>
                    {{ $studentNum }}
                </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="get-a-bro" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>DODIJELI MI VELIKOG BURAZA</h2>
                    <p>Proces prijave traje 1 minutu, samo kliknite na gumb i pratite upute.</p>
                    <a href="{{ route('student.login') }}" class="btn btn-default btn-lg">POSTANI MALI BURAZ</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="container text-center" style="margin-top: 100px;">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{{ route('mentor.login') }}" style="font-size: 18px;">Stariji si student/ica? Postani veliki buraz!</a>
            </div>
        </div>
    </section>
@endsection