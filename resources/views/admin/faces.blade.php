@extends('master.admin')

@section('header') Face - Veliki Buraz @endsection

@section('content')
    <h2>Informacijski i poslovni sustavi</h2>
    <div class="row">
        @foreach($ipiStudents as $student)
            <div class="col-md-4">
                <a href="{{ route('admin.face', ['userId' => $student->user_id]) }}">
                    <img src="{{ $student->user->avatar_url }}&width=500&height=500" alt="" class="img-responsive">
                </a>
            </div>
        @endforeach
    </div>
    <h2>Ekonomika poduzetništva</h2>
    <div class="row">
        @foreach($epStudents as $student)
            <div class="col-md-4">
                <a href="{{ route('admin.face', ['userId' => $student->user_id]) }}">
                    <img src="{{ $student->user->avatar_url }}&width=500&height=500" alt="" class="img-responsive">
                </a>
            </div>
        @endforeach
    </div>
    <h2>PITUP</h2>
    <div class="row">
        @foreach($pitupStudents as $student)
            <div class="col-md-4">
                <a href="{{ route('admin.face', ['userId' => $student->user_id]) }}">
                    <img src="{{ $student->user->avatar_url }}&width=500&height=500" alt="" class="img-responsive">
                </a>
            </div>
        @endforeach
    </div>
@endsection