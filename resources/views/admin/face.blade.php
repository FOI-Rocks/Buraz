@extends('master.admin')

@section('header') Face - Veliki Buraz @endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $face->avatar_url }}&height=1000" class="img-responsive" alt="">
        </div>
        <div class="col-md-6">
            <b>Ime:</b> <a target="_blank" href="http://facebook.com/{{ $face->fbid }}">{{ $face->name }}</a>
            <br>
            <b>E-mail:</b> {{ $face->email }}
        </div>
    </div>
@endsection