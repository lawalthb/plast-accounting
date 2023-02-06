@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<h3>{{ __('passwordReset') }}</h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="material-icons">email</i> {{ __('passwordResetMsg') }}
		</h4>
	</div>
	<hr />
	<a href="<?php print_link("/"); ?>" class="btn btn-info">{{ __('clickHereToLogin') }}</a>
</div>
@endsection