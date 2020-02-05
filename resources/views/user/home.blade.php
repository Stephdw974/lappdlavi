@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container px-3">
  <div class="bg-light p-3 text-dark rounded border text-center">

    <h2>Acces rapide</h2>
    <div class="list-group">
      <a href="{{ route('listes.showHome') }}" class="list-group-item list-group-item-action">Listes</a>
      <a href="{{ route('tricount.showHome') }}" class="list-group-item list-group-item-action">Tricount</a>
      <a href="{{ route('user.showDebug') }}" class="list-group-item list-group-item-action small p-2">Debugger</a>
    </div>

    <button onClick="$('#logout').submit()" class="btn btn-rb btn-block mt-3">Se déconnecter</button>
    <form id="logout" action="{{ route('logout') }}" method="post" class="d-none">
      @csrf
    </form>
  </div>

  <div class="bg-light p-3 text-dark rounded border text-center mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
      <b>Erreur !</b><br>
      @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
    @endif

    <div id="settingsTitle" onClick="$('#settings').slideToggle();">
      <h2 class="mb-0">Parametres</h2>
      <small>Click to toggle</small>
    </div>
    <div id="settings" style="display: none">
    <hr>
      <h5>Changer le code de sécurité</h5>
      <form class="form" action="{{ route('user.changePincode') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="number" value="{{ Auth::user()->settings->first()->pinCode ?? '0000'}}" name="pinCode" id="pinCode" class="form-control hidden-nunmber rounded-0 w-100">
          <div class="input-group-append">
            <button type="submit" class="btn btn-rb rounded-0 w-100">Valider</button>
          </div>
        </div>
      </form>


      <h5 class="mt-4">Changer de fond</h5>
      <form class="form" action="{{ route('user.changeBackground') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input type="file" name="backgroundImage" id="backgroundImage" class="form-control rounded-0 w-100" accept="image/png, image/jpeg">
          <div class="input-group-append">
            <button type="submit" class="btn btn-rb rounded-0 w-100">Valider</button>
          </div>
        </div>
      </form>

      <h5 class="mt-4">Changer la couleur principale</h5>
      <form class="form" action="{{ route('user.changeColor') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="color" name="mainColor" id="mainColor" value="{{ Auth::user()->settings->first()->mainColor ?? '#000' }}" class="form-control rounded-0 w-100">
          <div class="input-group-append">
            <button type="submit" class="btn btn-rb rounded-0 w-100">Valider</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection


@section('js')
@endsection


@section('css')
@endsection