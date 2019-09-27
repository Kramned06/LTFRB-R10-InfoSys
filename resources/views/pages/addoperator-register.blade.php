@extends('layouts.register-app')

@section('content')
<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <h4><strong>Register Operator</strong></h4>
        </div>
    </div>
    <form method="POST" action="{{ url('addOperator') }}">@csrf
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row form-group">
            <div class="col-4">
                <label for="firstname">{{ __('First name') }}</label>
                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" placeholder="First name" required autofocus autocomplete="nope">

                @if ($errors->has('firstname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-4">
                <label for="middlename">{{ __('Middle name') }}</label>
                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('middlename') }}" placeholder="Middle name" required autofocus autocomplete="nope">

                @if ($errors->has('middlename'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('middlename') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-4">
                <label for="surname">{{ __('Surname') }}</label>
                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" placeholder="Surname" required autofocus autocomplete="nope">

                @if ($errors->has('surname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="street">{{ __('Street') }}</label>
                <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" value="{{ old('street') }}" placeholder="Street" required autofocus autocomplete="nope">

                @if ($errors->has('street'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('street') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="barangay">{{ __('Barangay') }}</label>
                <input id="barangay" type="text" class="form-control{{ $errors->has('barangay') ? ' is-invalid' : '' }}" name="barangay" value="{{ old('barangay') }}" placeholder="Barangay" required autofocus autocomplete="nope">

                @if ($errors->has('barangay'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('barangay') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-4">
                <label for="city">{{ __('City') }}</label>
                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" placeholder="City" required autofocus autocomplete="nope">

                @if ($errors->has('city'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-4">
                <label for="country">{{ __('Country') }}</label>
                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" placeholder="Country" required autofocus autocomplete="nope">

                @if ($errors->has('country'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="state">{{ __('Province / state') }}</label>
                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" placeholder="State" required autofocus autocomplete="nope">

                @if ($errors->has('state'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col">
                <label for="post_code">{{ __('Postal code') }}</label>
                <input id="post_code" type="text" class="form-control{{ $errors->has('post_code') ? ' is-invalid' : '' }}" name="post_code" value="{{ old('post_code') }}" placeholder="Postal Code" required autofocus autocomplete="nope">

                @if ($errors->has('post_code'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('post_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="email">{{ __('Email address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Example@email.com" required autofocus autocomplete="nope">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-3">
                <label for="contact_number">{{ __('Contact number (#1)') }}</label>
                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{ old('contact_number') }}" placeholder="Contact number" required autofocus>

                @if ($errors->has('contact_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_number') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-3">
                <label for="contact_number_two">{{ __('Contact number (#2)') }}</label>
                <input id="contact_number_two" type="text" class="form-control{{ $errors->has('contact_number_two') ? ' is-invalid' : '' }}" name="contact_number_two" value="{{ old('contact_number_two') }}" placeholder="Contact number" required autofocus>

                @if ($errors->has('contact_number_two'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_number_two') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="remarks">{{ __('Remarks') }}</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
            </div>

            @if ($errors->has('remarks'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('remarks') }}</strong>
                </span>
            @endif
        </div>

        <div class="row form-group">
            <div class="col">
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                {{-- <button class="btn btn-light"><a href="{{ url('/inspect-home') }}">View all operator</a></button> --}}
                @if(Auth::user()->role == 3)
                    <button class="btn btn-light"><a href="{{ url('/register-home') }}">View all operator</a></button>
                @else
                    <button class="btn btn-light"><a href="{{ url('/inspect-home') }}">View all operator</a></button>
                @endif
            </div>
        </div>
    </form>
</div>


@endsection
