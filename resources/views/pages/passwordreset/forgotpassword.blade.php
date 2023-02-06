@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<div class="row">
		<div class="col-md-6">
			<div class="card-1">
				<div>
					<h3>{{ __('passwordReset') }}</h3>
					<div class="text-muted">
						{{ __('promptForValidEmail') }}
					</div>
				</div>
				<hr />
				@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
				@endif
				<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" />
					</div>
					@if ($errors->has('email'))
					<div class="alert alert-danger animated bounce">{{ $errors->first('email') }}</div>
					@endif
					<div>
						<button class="btn btn-success" type="submit"> {{ __('send') }} <i class="material-icons">email</i></button>
					</div>
				</form>
				<br />
				<div class="text-info">
					{{ __('passwordResetLinkMsg') }}
				</div>
			</div>
		</div>
	</div>

</div>
@endsection