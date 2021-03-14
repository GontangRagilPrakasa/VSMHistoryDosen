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
        <p class="login-box-msg">Enter Email to reset password</p>

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
        
        <form method="post" action="{{ url('/forgot-send') }}">
            @csrf

            <div class="form-group has-feedback {{ session('errors') == true ? 'has-error' : '' }}">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                    </button>
                </div>
            </div>

        </form>

    </div>
    <!-- /.login-box-body -->
@endsection