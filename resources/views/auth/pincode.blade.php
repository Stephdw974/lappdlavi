@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container bg-light text-dark p-4 text-center text-sm-left h-100">
<h1 class="mt-5 pt-5">CODE PIN</h1>

<form action="{{ route('pincode.authUser') }} " method="post">
  @csrf
<div class="form-group mb-5 pb-5">
  <input id="pincode" type="tel" class="form-control form-control-lg rounded-0 text-center text-sm-left" autofocus name="pincode" id="pincode">
</div>
</form>

</div>

@endsection


@section('js')
<script>

// window.onload = () => {
$('#pincode').on('keyup', function() {
  if($(this).val().length == 4){
    $.post('/pincode', { _token: "{{ csrf_token() }}", pincode: $(this).val() })
    .done(data => {
      if(data) {
        window.location.href ='/listes';
      }
    })
  } 
})
// }

</script>

@endsection


@section('css')

@endsection
