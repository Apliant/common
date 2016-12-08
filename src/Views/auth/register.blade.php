@extends('auth/authbase')

@section('title', 'Registration')

@section('content')
<div class="panel panel-success">
    <div class="panel-heading">
        <h2>Aplaint Registration</h2>
    </div>
    <div class="panel-body">
        <form class="register" method="POST" action="/auth/register">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>First Name</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" name="agent_first_name" value="{{ old('agent_first_name') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Middle Name</label>
                    </div>
                    <div class="col-lg-8">
                         <input type="text" name="agent_middle_name" value="{{ old('agent_middle_name') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Last Name</label>
                    </div>
                    <div class="col-lg-8">
                         <input type="text" name="agent_last_name" value="{{ old('agent_last_name') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Email</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Password</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="password" name="password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Confirm Password</label>
                    </div>
                    <div class="col-lg-8">
                         <input type="password" name="password_confirmation">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-4">
                    <input type="number" name="agency_id" value="1" hidden="true">
                    <button type="submit" class="btn btn-default">Register</button> or <a href="/auth/login">Login</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop