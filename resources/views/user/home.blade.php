@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container text-dark bg-white p-3">

  <h5>Changer de fond</h5>
  <form class="form" action="{{ route('user.changeBackground') }}" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="row">
      <div class="col-10">
        <input type="file" name="image" id="image" class="form-control rounded-0" accept="image/png, image/jpeg" style="height:44px;">
      </div>
      <div class="col-2">
        <button type="submit" class="btn btn-primary rounded-0" style="height:44px;">Submit</button>
      </div>
    </div>
  </form>
</div>


@endsection


@section('js')
@endsection


@section('css')
@endsection