@extends('layouts.admin')
@section('title', 'Dashboard')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
	
</script>
@endsection
@section('content')
&nbsp;

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('errors'))
            <div class="alert alert-danger">
                {!! session('errors') !!}
            </div>
        @endif
        
		<form action="{{ url('change-password') }}" method="post" accept-charset="utf-8">
			@csrf
			<div class="form-group has-feedback">
                <input type="text" class="form-control" name="" value="{{ $user->full_name }}" disabled>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="" value="{{ $user->email }}" disabled>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback {{ session('errors') == true ? 'has-error' : '' }}">
                <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" placeholder="Old Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

			<div class="form-group has-feedback {{ session('errors') == true ? 'has-error' : '' }}">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="New Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback {{ session('errors') == true ? 'has-error' : '' }}">
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-lock"></i> Reset Password
                    </button>
                </div>
            </div>
		</form>
	</div>			
</div>
@endsection