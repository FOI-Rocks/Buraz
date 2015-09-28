@extends('mentor.master')

@section('header') Informacije - Veliki Buraz @endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        @if(count($littleBros) > 100)
        <h3>Tvoji mali burazi:</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Ime i prezime</th>
                </tr>
            </thead>
            <tbody>
                @foreach($littleBros as $bro)
                <tr>
                    <td style="width: 80px;">
                        <img style="height:50px; width:50px;" class="img-circle" src="{{ $bro->user->avatar_url }}"
                    </td>
                    <td style="padding-top: 20px;">
                        {{ $bro->user->name }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3>Trenutno nemaš Malih Buraza, čim ti jedan/na bude dodijeljen bit ćeš obaviješten/a mailom.</h3>
        @endif
    </div>
</div>
@endsection