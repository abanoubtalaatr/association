
@extends('layouts.auth')
@section('content')
@livewire('front.verify-forget-password-code',['user' => $user])
@endsection
