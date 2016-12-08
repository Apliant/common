@extends('auth/authbase')

@section('title', 'Login')

@section('content')
<div class="panel panel-success">
    <div class="panel-heading">
        <h2>Apliant Login</h2>
    </div>
    <div class="panel-body">
        <form class="login" method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Email</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Password</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Remember Me</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="checkbox" name="remember">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-4">
                        <button name="login" type="submit" class="btn btn-default">Login</button> or <a href="/auth/register">Register</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@stop