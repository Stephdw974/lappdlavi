@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container px-3">
<div class="bg-light p-3 text-dark rounded border text-center">

    <h2>Acces rapide</h2>
    <div class="list-group">
      <a href="{{ route('listes.showHome') }}" class="list-group-item list-group-item-action">Listes</a>
      <a href="{{ route('tricount.showHome') }}" class="list-group-item list-group-item-action">Tricount (En développement)</a>
    </div>

    <button onClick="$('#logout').submit()" class="btn btn-rb btn-block mt-3">Se déconnecter</button>
    <form action="{{ route('logout') }}" method="post" class="d-none">
      @
    </form>
</div>

<div class="bg-light p-3 text-dark rounded border text-center mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
      <b>Erreur !</b><br>
      @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
    @endif


    <h2 class="mb-3">Parametres</h2> 

    <h5>Changer le code de sécurité</h5>
    <form class="form" action="{{ route('user.changePincode') }}" method="POST">
      @csrf
      <input type="tel" value="{{ strval(Auth::user()->settings->first()->pinCode) }}" name="pinCode" id="pinCode" class="form-control rounded-0 w-100"style="height:44px;">
      <button type="submit" class="btn btn-rb rounded-0 w-100">Submit</button>
    </form>


    <h5 class="mt-4">Changer de fond</h5>
    <form class="form" action="{{ route('user.changeBackground') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="backgroundImage" id="backgroundImage" class="form-control rounded-0 w-100" accept="image/png, image/jpeg" style="height:44px;">
      <button type="submit" class="btn btn-rb rounded-0 w-100">Modifier</button>
    </form>

    <h5 class="mt-4">Changer la couleur principale</h5>
    <form class="form" action="{{ route('user.changeColor') }}"  value="{{ strval(Auth::user()->settings->first()->mainColor) }}" method="POST">
      @csrf
      <input type="color" name="mainColor" id="mainColor" class="form-control rounded-0 w-100"style="height:44px;">
      <button type="submit" class="btn btn-rb rounded-0 w-100">Submit</button>
    </form>


  </div>
</div>

@endsection


@section('js')
@endsection


@section('css')
@endsection