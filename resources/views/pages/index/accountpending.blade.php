@extends('layouts.info')
@section('content')
<div class="container">
    <div class="my-4 text-center p-4 card-4">
        <i class="material-icons mi-lg text-warning">account_box</i>
        <div class="h4 text-bold text-warning my-3">
            {{ __('promptAccountInReview') }}
        </div>
        <div class="text-muted">
            {{ __('contactSystemAdmin') }}
        </div>
        <hr class="my-md" />
        <a href="{{ url('/') }}" class="btn btn-primary"><i class="material-icons">home</i> {{ __('continue') }}</a>
    </div>
</div>
@endsection