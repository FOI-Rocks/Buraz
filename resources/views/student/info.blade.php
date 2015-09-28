@extends('student.master')

@section('header') Informacije - Mali Buraz @endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        @if($mentor == null)
            <h3>Trenutno ti nije dodjeljen Veliki Buraz, kada ti on bude dodjeljen bit ćeš obaviješten/a mailom!</h3>
        @else
        <br>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Tvoj veliki buraz</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-3 col-lg-3 " align="center">
                    <img src="{{ $mentor->avatar_url }}" class="img-circle img-responsive">
                </div>
                <div class="col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Ime:</td>
                                <td>{{ $mentor->name }}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td>{{ $mentor->email }}</td>
                            </tr>
                            <tr>
                                <td>Broj mobitela</td>
                                <td>{{ $mentor->mentor->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection