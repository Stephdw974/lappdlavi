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
  <div class="bg-light p-3 text-dark rounded border text-center">
    <h2 class="font-weight-bold">{{$TcPartage->name}}</h2>
    <h6>{{$TcPartage->amount}} EUR</h6>

    <div class="my-5">
      Payé par <b>{{ $TcPartage->payedBy }}</b>
    </div>

    <div class="my-5">
      <div class="list-group">
        @foreach(explode(',', str_replace(', ', ',', $TcPartage->payedFor)) as $payedFor)
        <div class="list-group-item list-group-item-action rounded-0">
          <div class="row">
            <div class="col text-left">{{ $payedFor }}</div>
            <div class="col text-right"> - {{ $TcPartage->amount / count(explode(',', str_replace(', ', ',', $TcPartage->payedFor))) }} EUR</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>


    @auth
    <a href="#" onClick="$('#deletePartage').submit()">Supprimer</a>
    <form id="deletePartage" method="POST" type="hidden" action="{{ route('tricount.deletePartage', [$TcCompte->id, $TcPartage->id]) }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>
    @endauth
  </div>
</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection