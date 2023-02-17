@extends('layouts.app')
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('myProfile.css') }}" />
</head>

<body class="d-flex flex-column min-vh-100">
    <section id="banner" class="my-5 py-4">
        <div class="container-flex">
            <h5 class="pt-3 title-text">Welcome back, {{ Auth::user()->name }} </h5>
        </div>
    </section>
    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <section id="list-banner" class="container-flex mb-3 ">
        <a class="btn btn-bar mr-5" href="{{url('myOrders')}}">My Orders</a>
        <a class="btn btn-bar btn-live ml-5" href="{{url('/myProfile')}}">My Profile</a>
    </section>

    <section id="update-details" class="container-sm ">
        <form action="{{ route('users.update') }}" method="POST">
            @method('patch')
            @csrf
            <div class="form-control row mb-4">
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
            </div>
            <div class="form-control row mb-4">
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
            </div>
            <div>Leave password blank to keep current password</div>
            <div class="form-control row mb-4">
                <input id="password" type="password" name="password" placeholder="Password">
            </div>

            <div class="form-control row mb-4">
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="row">
                <div class="col mb-5">
                    <button type="submit" class="my-profile-button btn btn-primary">Update Profile</button>
                </div>
            </div>
        </form>
    </section>
</body>
@endsection
@method('patch')

{{-- @csrf
<div class="row mb-4">
    <input id="name" type="text" class="form-control" value="{{old('name',$user->name)}}" placeholder="Name" >
</div>

<div class="row mb-4">
    <input id="email" type="email" class="form-control" value="{{old('name',$user->email)}}" readonly >
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="row mb-4">
    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
    <div>Leave password blank to keep current password</div>
</div>

<div class="row mb-4">
    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
</div>

<div class="row">
    <div class="col mb-5">
        <button type="submit" class="btn btn-primary">
            {{ __('Update Profile') }}
        </button>
    </div>
</div> --}}
