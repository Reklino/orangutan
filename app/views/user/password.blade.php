@extends('layouts.master')

@section('content')

    <h1>Change Password</h1>

    {{ Form::open(array('method' => 'put')) }}

        <div>
            {{ Form::label('password', 'Current Password:') }}
            {{ Form::password('password') }}
        </div>

        <div>
            {{ Form::label('newPassword', 'New Password:') }}
            {{ Form::password('newPassword') }}
        </div>

        <div>
            {{ Form::label('confirmPassword', 'Confirm Password:') }}
            {{ Form::password('confirmPassword') }}
        </div>

        <div>
            {{ Form::submit('Submit') }}
        </div>
    {{ Form::close() }}

    {{ HTML::ul($errors->all()) }}

@stop