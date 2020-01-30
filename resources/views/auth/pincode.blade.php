@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container bg-light text-dark p-4 text-center text-sm-left h-100">
<h1 class="mt-5 pt-5">CODE PIN</h1>

<form action="{{ route('pincode.authUser') }} " method="post">
  @csrf
<div class="form-group mb-5 pb-5">
  <input type="tel" class="form-control form-control-lg rounded-0 text-center text-sm-left" autofocus name="pincode" id="pincode">
</div>
</form>

</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection
