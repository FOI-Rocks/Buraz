@extends('student.master')

@section('header') Profil - Mali Buraz @endsection

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
        <h1>Profil</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal text-center" action="{{ route('student.store') }}" method="POST">
            <fieldset>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <img class="img-circle" src="{{ $user->avatar_url }}">
                <br><br>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="name">Ime i prezime</label>
                  <div class="col-md-6">
                  <input id="name" name="name" type="text" class="form-control input-md" required="" value="{{ $user->name }}">

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email">E-mail adresa</label>
                  <div class="col-md-6">
                  <input id="email" name="email" type="text" class="form-control input-md" required="" value="{{ $user->email }}">

                  </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="study_id">Odaberi smjer</label>
                  <div class="col-md-6">
                    <select id="study_id" name="study_id" class="form-control" >
                      <option value="0">-- ODABERI SMJER --</option>
                      <option value="1"@if($user->study_id == 1) selected @endif>Informacijski i poslovni sustavi</option>
                      <option value="2"@if($user->study_id == 2) selected @endif>Ekonomika poduzetništva</option>
                      <option value="3"@if($user->study_id == 3) selected @endif>PITUP</option>
                    </select>
                  </div>
                </div>

            </fieldset>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Spremi</button>
            </div>
        </form>
    </div>
</div>
@endsection