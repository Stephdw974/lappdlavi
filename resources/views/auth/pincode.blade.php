@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container p-4 text-center text-sm-left h-100">
<h1 class="mt-5 pt-5">CODE PIN</h1>
<div id="callback"></div>

<form action="{{ route('pincode.authUser') }} " method="post">
  @csrf
<div class="form-group mb-5 pb-5">
  <input id="pincode" type="tel" class="form-control hidden-nunmber form-control-lg rounded-0 text-center text-sm-left" autofocus autocomplete="off" name="pincode" id="pincode">
</div>
</form>

<a href="{{ route('register') }}">Inscription</a>
 - 
<a href="{{ route('login') }}">Connexion sans pin</a>

</div>

@endsection


@section('js')
<script>

// window.onload = () => {
$('#pincode').on('keyup', function() {
  if($(this).val().length == 4){
    $.post('/pincode', { _token: "{{ csrf_token() }}", pincode: $(this).val() })
    .done(data => {
      if(data.name) {
        $('#callback').html('<div class="alert alert-success">Authentification réussie '+ data.name+'.<br>Redirection en cours...</div>')
        setTimeout( () => {
          window.location.href ='/listes'
        }, 500)

      }
    })
    .fail(data => {
      if(data.responseJSON.message === "Unauthenticated.") {
        $('#callback').html('<div class="alert alert-danger">Authentification impossible. Reessayez !</div>')
        $(this).val('')
      }
    })
  } 
})
// }

</script>

@endsection


@section('css')

@endsection
