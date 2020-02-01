@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container p-3">

  <h5>Changer de fond</h5>
  <form class="form" action="{{ route('user.changeBackground') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" id="image" class="form-control rounded-0 w-100" accept="image/png, image/jpeg" style="height:44px;">
    <button type="submit" class="btn btn-rb rounded-0 w-100">Submit</button>
  </form>

  <h5 class="mt-5">Acces rapide</h5>
  <div class="list-group">
    <a href="{{ route('listes.showHome') }}" class="list-group-item list-group-item-action">Listes</a>
  </div>
</div>

@endsection


@section('js')
@endsection


@section('css')
@endsection