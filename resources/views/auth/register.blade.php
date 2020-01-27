@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Username</label>
            <input value="{{ old('name') }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus>
            @error('name') <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input value="{{ old('email') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email') <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input value="{{ old('password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password') <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirmation du mot de passe</label>
            <input value="{{ old('password_confirmation') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary w-100">Inscription</button>
        </div>
    </form>
</div>
@endsection