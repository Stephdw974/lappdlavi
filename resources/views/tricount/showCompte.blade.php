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

<div class="container">

  <div class="list-group">
    @foreach($TcCompte->partages() as $partage)
    <a href="{{ route('tricount.showPartage', $partage->id) }}" class="list-group-item list-group-item-action">{{ $partage->name }}</a>
    @endforeach
  </div>

</div>

<div class="fixed-bottom text-center">
  <a href="{{ route('tricount.showPartageCreation', $TcCompte->id) }}" class="btn btn-rb border-secondary mb-3"><i class="fas fa-plus fa-2x"></i></a>
</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection