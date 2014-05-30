@extends('layouts.master')

@section('content')

    <h1>Login</h1>

    {{ Form::open() }}
        <div>
            {{ Form::label('email', 'Email Address:') }}
            {{ Form::email('email') }}
        </div>

        <div>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
        </div>

        <div>
            {{ Form::submit('Login') }}
        </div>
    {{ Form::close() }}

    {{ HTML::ul($errors->all()) }}

    {{ link_to_action('RemindersController@getRemind', 'Forgot Password?', $parameters = array(), $attributes = array('class' => 'btn')) }}

@stop


