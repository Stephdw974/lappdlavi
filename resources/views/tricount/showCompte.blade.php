@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container mb-3">
  <div class="btn-group">
    <a href="#" action="goBack" class="btn btn-dark border-secondary">
      <i class="fas fa-angle-double-left mr-2"></i> Retour
    </a>
  </div>
  <div class="btn-group float-right">
    <a href="#" action="deleteCompte" class="btn btn-dark border-secondary"><i class="fas fa-trash"></i></a>
    <a href="#" action="showStats" class="btn btn-dark border-secondary"><i class="fas fa-info-circle"></i></a>
  </div>
</div>

<div id="stats" class="container px-3 pb-3" style="display: none">
  <div class="bg-light border rounded p-3 text-center">
    <h3>Statistiques</h3>
    <hr class="my-1">
    Montant total : {{ $TcCompte->partages()->sum('amount') }} €<br>
    @foreach(explode(',', str_replace(', ', ',', $TcCompte->members)) as $member)
    @foreach($stats as $stat)
    @if($member == $stat["Name"])
    <div class="my-3">
      {{ $stats[0] }}
      <!-- {{ $stat["Name"] }} -->
      <div class="progress " style="height: 25px;">
        <div class="progress-bar mx-auto @if($stat['Owed'] >= 0) bg-success @else bg-danger @endif" role="progressbar" style="width: {{ 50+((($stat['Owed'] / ($TcCompte->partages()->sum('amount')+0.1) )*100)/2) ?? 50}}%" aria-valuenow="{{ 50+((($stat['Owed'] / ($TcCompte->partages()->sum('amount')+0.1) )*100)/2) ?? 50 }}" aria-valuemin="0" aria-valuemax="100">@if($stat['Owed'] > 0)+@endif{{ $stat['Owed'] }} €</div>
      </div>
    </div>
    @endif
    @endforeach
    @endforeach
  </div>
</div>

<div class="container">
  <div class="list-group">
    @foreach($TcCompte->partages()->orderBy('created_at', 'DESC')->get() as $partage)
    <a href="{{ route('tricount.showPartage', [$TcCompte->id, $partage->id]) }}" class="list-group-item list-group-item-action">{{ $partage->name }}</a>
    @endforeach
  </div>
</div>

<div class="fixed-bottom text-center">
  <a href="{{ route('tricount.showPartageCreation', $TcCompte->id) }}" class="btn btn-rb border-secondary mb-3"><i class="fas fa-plus fa-2x"></i></a>
</div>


<form id="deleteCompte" method="POST" type="hidden" action="{{ route('tricount.deleteCompte', $TcCompte->id) }}">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
</form>

@endsection


@section('js')

<script>
  $('[action="deleteCompte"]').on('click', function() {
    $('#deleteCompte').submit()
  })
  $('[action="showStats"]').on('click', function() {
    $('#stats').slideToggle()
  })
</script>

@endsection


@section('css')

@endsection