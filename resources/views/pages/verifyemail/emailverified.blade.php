@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<h4>{{ __('emailVerificationCompleted') }}</h4>
	<hr />
	<div class="">
		<a href="{{ route('home') }}" class="btn btn-primary">{{ __('continue') }}</a>
	</div>
</div>
@endsection