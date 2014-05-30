@extends('layouts.master')

@section('content')
    <!--                                   Header                                   -->

    <div class="page-header">
        <h2>Reset Password
            <br><small>Enter your new password below. Don't forget it this time!</small>
        </h2>
    </div>

    <!--                                   Alert Box                                    -->

    @if (Session::has('error'))
        <div class="alert alert-info">{{ Session::get('error') }}</div>
    @endif

    <!--                                   Form                                   -->

    {{ Form::open(array('class' => 'form-horizontal')) }}

        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Address -->
        <div class="form-group">
            {{ Form::label('email', 'Email Address:', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-9">
                {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            {{ Form::label('password', 'New Password:', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-9">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'New Password')) }}
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm Password:', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-9">
                {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
            </div>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                {{ Form::submit('Send Reminder', array('class' => 'btn btn-default')) }}
            </div>
        </div>

    </form>

@stop