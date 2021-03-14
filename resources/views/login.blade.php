@extends('layouts.login')
@section('title', 'Login')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
	$(document).ready(function(){
		$('#frmLogin').submit(function(){
			if( $('#txtUserName').val()=="" ){
				alertBox('show', {msg: 'Username tidak boleh kosong'});
				$('#txtUserName').focus();
				return;
			}
			if( $('#txtPassword').val()=="" ){
				alertBox('show', {msg: 'Password tidak boleh kosong'});
				$('#txtPassword').focus();
				return;
			}
			
			postData = new Object();
			$.each($('#frmLogin :input').serializeObject(), function(x, y){ postData[x]=y; });

			ajax({
				url : "{{ url('login') }}", 
				postData : postData,
				success : function(ret){
					setTimeout(function(){
						blockUI('body', true, 'Please wait', '300px');
						window.location.replace(ret.redirect);
					}, 100);
				},
			});			
		});			
	});
</script>
@endsection
@section('content')
<p class="login-box-msg">Sign in to start your session</p>
<form id="frmLogin" onSubmit="return false" method="post">
	<div class="form-group has-feedback">
		<input id="txtUserName" type="email" class="form-control" placeholder="Email">
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		<input id="txtPassword" type="password" class="form-control" placeholder="Password">
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<div class="row">
		<div class="col-xs-8">
			<div class="checkbox icheck">
				<input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
				<label class="custom-control-label" for="remember_me"><span>Remember Me</span></label>
			</div>
		</div>
		<div class="col-xs-4">
			<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
		</div>
	</div>
</form>
{{-- <a href="{{ url('/forgot-password') }}">Lupa password</a><br> --}}
@endsection