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
    <h1>{{$TcPartage->name}} - {{ $TcPartage->amount }}€</h1>
    <hr>

    <div class="my-5">
      <h3 class="mb-0">Payé par</h3>
      {{ $TcPartage->payedBy }}
    </div>

    <div class="my-5">
    <h3 class="mb-0">Payé pour</h3>
    @foreach(explode(',', str_replace(', ', ',', $TcPartage->payedFor)) as $payedFor)
    {{ $payedFor }}@if(!$loop->last), @endif
    @endforeach
    </div>
  </div>
</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection