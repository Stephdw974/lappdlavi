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

    <div class="mb-4" id="User">
      <h1 class="mb-0">User</h1>

      <span class="font-weight-bold text-uppercase mr-1">ID : </span>
      <span class="font-weight-light">{{ Auth::user()->id }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">NAME : </span>
      <span class="font-weight-light">{{ Auth::user()->name }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">EMAIL : </span>
      <span class="font-weight-light">{{ Auth::user()->email }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">CREATED_AT : </span>
      <span class="font-weight-light">{{ Auth::user()->created_at }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">UPDATED_AT : </span>
      <span class="font-weight-light">{{ Auth::user()->updated_at }}</span><br>

    </div>
    <div class="mb-4" id="UserSettings">
      <h1 class="mb-0">Settings</h1>

      <span class="font-weight-bold text-uppercase mr-1">Backgound_IMAGE : </span>
      <span class="font-weight-light"><a href="/backgrounds/{{ Auth::user()->settings->first()->backgroundImage }}" target="_blank">Click to open</a></span><br>

      <span class="font-weight-bold text-uppercase mr-1">Main_Color : </span>
      <span class="font-weight-light">{{ Auth::user()->settings->first()->mainColor }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">CREATED_AT : </span>
      <span class="font-weight-light">{{ Auth::user()->settings->first()->created_at }}</span><br>

      <span class="font-weight-bold text-uppercase mr-1">UPDATED_AT : </span>
      <span class="font-weight-light">{{ Auth::user()->settings->first()->updated_at }}</span><br>

    </div>
    <div class="mb-4" id="UserLists">
      <h1 class="mb-0">Lists (En développement)</h1>
      {{ Auth::user()->listes()->get() }}
    </div>
    <div class="mb-4" id="UserComptes">
      <h1 class="mb-0">Comptes (En développement)</h1>
      {{ Auth::user()->comptes()->get() }}
    </div>

  </div>
</div>

@endsection


@section('js')

@endsection


@section('css')

@endsection