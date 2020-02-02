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
    <button type="button" class="btn btn-dark border-secondary" data-toggle="modal" data-target="#showMembers"><i class="fas fa-users"></i></button>
  </div>
</div>

<div class="container">

  <div class="list-group">
    @foreach($TcCompte->partages()->get() as $partage)
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

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="showMembers" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Membres du Tricount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach(explode(',', str_replace(', ', ',', $TcCompte->members)) as $member)
        {{ $member }}@if(!$loop->last), @endif
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection


@section('js')

<script>
  $('[action="deleteCompte"]').on('click', function() {
    $('#deleteCompte').submit()
  })
</script>

@endsection


@section('css')

@endsection