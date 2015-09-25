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
                            <b>Neslužbeni projekt studentskog mentorstva brucošima</b>
                            <br>
                            Dodjeli si svog "velikog buraza" i on će biti uz tebe sa informacijama iz prve ruke, kad i ako ti to zatreba.
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
                    Ovo je eksperimentalni i neslužbeni projekt kojim spajamo dobrovoljne studente starijih godina (tzv. velike buraze) koji žele podjeliti svoje savjete i iskustva iz prve ruke brucošima (tzv. malim burazima).
                </p>
                <p>
                    Princip je vrlo jednostavan, stariji studenti koji žele sudjelovati nasumično se dodjele svakom brucošu koji zatraži svog buraza. Mali buraz tada dobije kontakt informacije (facebook ime, e-mail, telefon) kojim se može, ali i nemora javiti. Svakako preporučamo da se javite svom velikom burazu kad vam se dodjeli, no nije obavezno, on vam može biti u pripravnosti ako ga ikad zatrebate.
                </p>
                <p>
                    <b>Sa čime vam veliki buraz može pomoći?</b>
                    <br>
                    Prva godina fakulteta je svima zbunujući trenutak u životu, preplavljeni ste informacijama, neznate kako taj cijeli sustav funkcionira i niste upoznati s profesorima. Tu uskače vaš veliki buraz, ukoliko vam nije nešto jasno o principu studiranja, ECTS-a, kolokvija, ispita ili pak trebate savjet koji kolegij upisati a koji ne, pitajte! Vašem burazu neće biti problem odvojiti 2 minute svog vremena da vam odgovori na pitanje. Koliko god glupo se vama činilo, svi smo imali taj problem u jednom trenutku. :)
                </p>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="get-a-bro" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>DODJELI MI VELIKOG BURAZA</h2>
                    <p>Proces prijave traje 1 minutu, samo kliknite na gumb i pratite upute.</p>
                    <a href="{{ route('student.login') }}" class="btn btn-default btn-lg">POSTANI MALI BURAZ</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="container text-center" style="margin-top: 100px;">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{{ route('mentor.login') }}">Stariji si student? Postani veliki buraz!</a>
            </div>
        </div>
    </section>
@endsection