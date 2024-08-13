@extends('layouts.app', [
    'bodyClass' => 'hold-transition login-page'
])

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input value="{{ old('email') ?? '' }}" type="email" class="form-control" name="email" placeholder="Email" dusk="email-input">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <div class="input-group mb-3 text-danger justify-content-center">
                        {{ $message }}
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" dusk="password-input">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <div class="input-group mb-3 text-danger justify-content-center">
                        {{ $message }}
                    </div>
                @enderror
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" dusk="sign-in-button">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
