@extends('layouts.inspect-app')

@section('content')
<div class="container">
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
                <label for="sticker_number">{{ __('Sticker number (RX)') }}</label>
                <input id="sticker_number" type="text" class="form-control{{ $errors->has('sticker_number') ? ' is-invalid' : '' }}" name="	sticker_number" value="{{ old('sticker_number') }}" placeholder="Sticker number (RX)" required autofocus>

                @if ($errors->has('sticker_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('	sticker_number') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="col-5">
                <label for="tradename">{{ __('Tradename') }}</label>
                <input id="tradename" type="text" class="form-control{{ $errors->has('tradename') ? ' is-invalid' : '' }}" name="tradename" value="{{ old('tradename') }}" placeholder="Tradename" required autofocus>

                @if ($errors->has('tradename'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tradename') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-3">
                <label for="year_model">{{ __('Year model') }}</label>
                <select name="year_model" class="form-control">
                    <option value="{{ now()->year}}">{{ now()->year }}</option>
                    <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                    <option value="{{ now()->year - 2 }}">{{ now()->year - 2 }}</option>
                    <option value="{{ now()->year - 3 }}">{{ now()->year - 3 }}</option>
                    <option value="{{ now()->year - 4 }}">{{ now()->year - 4 }}</option>
                    <option value="{{ now()->year - 5 }}">{{ now()->year - 5 }}</option>
                    <option value="{{ now()->year - 6 }}">{{ now()->year - 6 }}</option>
                    <option value="{{ now()->year - 7 }}">{{ now()->year - 7 }}</option>
                </select>

                @if ($errors->has('year_model'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year_model') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-3">
                <label for="case_number">{{ __('Case number') }}</label>
                <select name="case_number" class="form-control">
                    <option value="">Case number . . .</option>
                    @foreach ($franchise as $user)
                        <option value="{{ $user->id }}">{{ $user->case_number }}</option>
                    @endforeach
                </select>

                @if ($errors->has('case_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('case_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-3">
                <label for="motor_number">{{ __('Motor number') }}</label>
                <select name="motor_number" class="form-control">
                    <option value="">Motor number . . .</option>
                    @foreach ($unit as $user)
                        <option value="{{ $user->id }}">{{ $user->motor_number }}</option>
                    @endforeach
                </select>

                @if ($errors->has('motor_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('motor_number') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="col-3">
                <label for="chassis_number">{{ __('Chassis number') }}</label>
                <select name="chassis_number" class="form-control">
                    <option value="">Chassis number . . .</option>
                    @foreach ($unit as $user)
                        <option value="{{ $user->id }}">{{ $user->chassis_number }}</option>
                    @endforeach
                </select>

                @if ($errors->has('chassis_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('chassis_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-3">
                <label for="plate_number">{{ __('Plate number') }}</label>
                <select name="plate_number" class="form-control">
                    <option value="">Plate number . . .</option>
                    @foreach ($unit as $user)
                        <option value="{{ $user->id }}">{{ $user->plate_number }}</option>
                    @endforeach
                </select>

                @if ($errors->has('plate_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('plate_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="operator_name">{{ __('Operator name') }}</label>
                <select name="operator_name" class="form-control">
                    <option value="">Operator name . . .</option>
                    @foreach ($operator as $user)
                        <option value="{{ $user->id }}">{{ $user->surname }}, {{ $user->firstname }}</option>
                    @endforeach
                </select>

                @if ($errors->has('operator_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('operator_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="remarks">{{ __('Remarks') }}</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="5"></textarea>
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
                <button class="btn btn-light"><a href="{{ url('/unit') }}">View all unit</a></button>
            </div>
        </div>
    </form>
</div>


@endsection
