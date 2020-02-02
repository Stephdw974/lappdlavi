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
  <div class="bg-light p-3 text-dark rounded border">

    <h5>Nouveau partage</h5>
    
    @if ($errors->any())
    <div class="alert alert-danger">
      <b>Erreur !</b><br>
      @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
    @endif

    <form class="form" action="{{ route('tricount.createPartage', $TcCompte->id) }}" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" name="name" id="name" class="form-control" autofocus>
      </div>

      <div class="form-group">
        <label for="amount">Montant</label>
        <input type="text" name="amount" id="amount" class="form-control">
      </div>

      <div class="form-group">
        <label for="payedBy">Payé par</label>
        <select class="form-control" name="payedBy" id="payedBy">
          @foreach(explode(',', str_replace(', ', ',', $TcCompte->members)) as $member)
          <option value="{{ $member }}">{{ $member }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Payé pour</label>
        @foreach(explode(',', str_replace(', ', ',', $TcCompte->members)) as $member)
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="payedFor_{{ $member }}" checked value="{{ $member }}">
          <label class="custom-control-label" for="payedFor_{{ $member }}">{{ $member }}</label>
        </div>
        @endforeach
        <input type="hidden" name="payedFor">
      </div>

      <button type="submit" class="btn btn-rb w-100">Créer</button>

    </form>
  </div>
</div>

@endsection


@section('js')
<script>
  var payedFor = []

  $('.custom-control-input').on('change', function() {
    if ($(this).is(':checked') && !payedFor.includes($(this).val())) {
      payedFor.push($(this).val())
    } else if (!$(this).is(':checked') && payedFor.includes($(this).val())) {
      payedFor.splice(payedFor.indexOf($(this).val()))
    }

    $('[name="payedFor"]').val(payedFor)
    console.log(payedFor)
  })
</script>
@endsection


@section('css')

@endsection