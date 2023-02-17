@extends('layouts.app')

@section('content')

<body class="d-flex flex-column min-vh-100">
    <div class="container mt-5 pt-3">
        <h1 class="title-text">REGISTER</h1>
        <h2>Welcome to the crew!</h2> <!-- This sounds awful but I need it as placeholder text-->
        <h6>Already have an account? <a class="btn btn-bar" href="{{ Route('login') }}">Login here!</a></h6>
    </div>
    <div class="container-sm mt-5">
        <div class="col">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-4">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row mb-4">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row mb-4">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row mb-4">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="row">
                    <div class="col mb-5">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
