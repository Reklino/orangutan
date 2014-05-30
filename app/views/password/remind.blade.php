@extends('layouts.master')

@section('content')

    <!--                                   Header                                   -->

    <div class="page-header">
        <h2>Need to reset your password?
            <br><small>Enter the email address associated with this application below</small>
        </h2>
    </div>

    <!--                                   Alert Box                                    -->

    @if (Session::has('error'))
        <div class="alert alert-info">{{ Session::get('error') }}</div>
    @elseif (Session::has('status'))
        <div class="alert alert-info">{{ Session::get('status') }}</div>
    @endif

    <!--                                   Form                                   -->

    {{ Form::open(array('class' => 'form-horizontal')) }}
            
        <!-- Email Address -->
        <div class="form-group">
            {{ Form::label('email', 'Email Address:', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-9">
                {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
            </div>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                {{ Form::submit('Send Reminder', array('class' => 'btn btn-default')) }}
            </div>
        </div>

    {{ Form::close() }}

@stop