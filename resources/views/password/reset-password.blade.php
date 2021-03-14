@extends('layouts.admin-login')
@section('title', 'Login Admin')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
    
</script>
@endsection
@section('content')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset password <b>{{ $user->user_full_name }}</b></p>

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
        
        <form method="post" action="{{ url('/update-password/'.$user->reset_password) }}">
            @csrf

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
    <!-- /.login-box-body -->
@endsection