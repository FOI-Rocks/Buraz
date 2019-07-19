@extends('master.admin')

@section('header') Postavke - Veliki Buraz @endsection

@section('content')
    <div class="row">
        <div class="col-md-4 mt-2">
            <button type="button" onclick="executeActions();" class="btn btn-dark">Ugasi matching i resetiraj podatke
            </button>
        </div>
        <div class="col-md-4 mt-2">
            <button type="button" onclick="startMatching();" class="btn btn-dark">Upali matching
            </button>
        </div>
        <div class="col-md-4 mt-2">
            <button type="button" onclick="notifyMatch();" class="btn btn-dark">Obavijesti korisnike
            </button>
        </div>
        <div class="col-md-4 mt-2">
            <button type="button" onclick="clearConsole();" class="btn btn-dark">Obriši konzolu
            </button>
        </div>
    <p id="console-log">

    </p>

    </div>
    <script type="text/javascript" src="{{ URL::asset('js/settings.js') }}"></script>
@endsection