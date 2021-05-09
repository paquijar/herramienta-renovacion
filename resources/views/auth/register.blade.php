@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="container ">
        <div class="row ">
            <div class="col-md-8" style="color:rgba(255, 255, 255, 0.8);">
                <br></br>
                <div class="text-center">
                    <h3>
                        <strong>
                            Crear Usuario
                        </strong>
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-5">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cargo" class="col-md-5 col-form-label text-md-right">{{ __('Cargo') }}</label>

                            <div class="col-md-5">
                                <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ old('cargo') }}">

                                @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display:none">
                            <label for="rol" class="col-md-5 col-form-label text-md-right">{{ __('Rol') }}</label>

                            <div class="col-md-5">
                                <select name="rol" class="form-control" required>
                                    <option selected value="12"></option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row" style="display:none">
                            <label for="hospital_id" class="col-md-5 col-form-label text-md-right">{{ __('Institución de salud') }}</label>

                            <div class="col-md-5">
                                <select name="hospital_id" class="form-control" required>
                                    @foreach ($param[1] as $hospital)
                                    <option @if ($hospital->id==$param[2])
                                        selected
                                        @endif
                                        value="{{ $hospital->id }}">{{ $hospital->nombre }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-5">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br></br>
                        <div class="form-group row mb-0">
                            <div class="col align-self-center text-center">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
