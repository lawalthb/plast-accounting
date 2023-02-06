@extends('layouts.info')
@section('content')
<div class="container">
    <div class="my-4 text-center p-4 card-4">
        <i class="material-icons mi-lg text-success">check_circle</i>
        <div class="h2 text-bold text-success my-md">
            {{ __('congratulations') }}
        </div>
        <div class="h4">
            {{ __('promptAccountCreated') }}
        </div>
        
        <hr class="my-md" />
        <a href="{{ url('/home') }}" class="btn btn-primary"><i class="material-icons">home</i> {{ __('continue') }}</a>
    </div>
</div>
@endsection