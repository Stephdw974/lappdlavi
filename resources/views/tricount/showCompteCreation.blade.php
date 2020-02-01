@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container mb-3">
  <div class="btn-group">
    <a href="#" action="goBack" class="btn btn-dark border-secondary">
      <i class="fas fa-angle-double-left mr-2"></i> Retour
    </a>
  </div>
</div>

<div class="container px-3">
  <div class="bg-light p-3 text-dark rounded border">

    <h5>Nouveau compte</h5>
    
    @if ($errors->any())
    <div class="alert alert-danger">
      <b>Erreur !</b><br>
      @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
    @endif

    <form class="form" action="{{ route('tricount.createCompte') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Nom du Tricount</label>
        <input type="text" name="name" id="name" class="form-control" autofocus>
      </div>

      <div class="form-group">
        <label for="members">Participants (séparés par une virgule)</label>
        <input type="text" name="members" id="members" class="form-control">
      </div>

      <button type="submit" class="btn btn-rb w-100">Créer</button>

    </form>
  </div>
</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection