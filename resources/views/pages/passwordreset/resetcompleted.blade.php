@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h2>{{ __('passwordReset') }}</h2>
				<hr />	
				<h4 class="animated bounce text-success">
					<i class="material-icons">check_circle</i> {{ __('passwordChangedMsg') }}
				</h4>
				<hr />
			</div>
			<br />
			<a href="<?php print_link("/"); ?>" class="btn btn-info">{{ __('clickHereToLogin') }}</a>
		</div>
	</div>
</div>
@endsection