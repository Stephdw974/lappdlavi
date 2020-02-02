@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container px-3">
  <div class="bg-light p-3 text-dark rounded border">

    @if ($errors->any())
    <div class="alert alert-danger">
      <b>Erreur !</b><br>
      @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
    @endif

    <h5>Changer de fond</h5>
    <form class="form" action="{{ route('user.changeBackground') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="image" id="image" class="form-control rounded-0 w-100" accept="image/png, image/jpeg" style="height:44px;">
      <button type="submit" class="btn btn-rb rounded-0 w-100">Submit</button>
    </form>

    <h5 class="mt-5">Acces rapide</h5>
    <div class="list-group">
      <a href="{{ route('listes.showHome') }}" class="list-group-item list-group-item-action">Listes</a>
      <a href="{{ route('tricount.showHome') }}" class="list-group-item list-group-item-action">Tricount</a>
    </div>
  </div>
</div>

@endsection


@section('js')
@endsection


@section('css')
@endsection