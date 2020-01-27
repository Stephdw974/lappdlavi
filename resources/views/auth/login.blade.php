@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input value="{{ old('email') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email') <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password') <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary w-100">Connexion</button>
        </div>
    </form>
</div>
@endsection