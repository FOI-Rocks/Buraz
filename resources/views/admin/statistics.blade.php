@extends('master.admin')

@section('header') Statistika - Veliki Buraz @endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="statistic">
                <div class="value">{{ $ipiMentors }}</div>
                <div class="label">Veliki IPS</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ $ipiStudents }}</div>
                <div class="label">Mali IPS</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ round($ipiStudents/$ipiMentors*100) }}%</div>
                <div class="label">Omjer IPS</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic">
                <div class="value">{{ $epMentors }}</div>
                <div class="label">Veliki EP</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ $epStudents }}</div>
                <div class="label">Mali EP</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ round($epStudents/$epMentors*100) }}%</div>
                <div class="label">Omjer EP</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic">
                <div class="value">{{ $pitupMentors }}</div>
                <div class="label">Veliki PITUP</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ $pitupStudents }}</div>
                <div class="label">Mali PITUP</div>
            </div>
            <br>
            <div class="statistic">
                <div class="value">{{ round($pitupStudents/$pitupMentors*100) }}%</div>
                <div class="label">Omjer PITUP</div>
            </div>
        </div>
    </div>
@endsection