@extends('layouts.app')

@section('content')

<div style="margin-top: 5rem;">
    <h1>Thanks for your purchase!</h1>
    <h6>Thank you for choosing Jewelz for your jewellery needs. </h6>
    <button><a href="{{url('/home')}}">Return to home</a></button>
</div>
@endsection
