@extends('layouts.register-app')

@section('content')
<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <h4><strong>Register Unit</strong></h4>
        </div>
    </div>
    <form method="POST" action="{{ url('addUnit') }}" autocomplete="off">@csrf
        <div class="row form-group">
            <div class="col">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-warning" style="padding: 2px 10px;border-radius:.25rem;margin-bottom:0px;">
                        <button type="button" class="close" data-dismiss="alert" style="padding-left:10px;">×</button>
                        {{-- <strong>Whoops!</strong> There were no found with your input. {{ $errors }} --}}
                        
                        @foreach ($errors->all() as $error)
                            <strong>Read me! </strong> {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <div class="col">
                <label for="case_number">{{ __('Case number') }}</label>
                <input id="case_number" type="text" class="form-control{{ $errors->has('case_number') ? ' is-invalid' : '' }}" name="case_number" value="{{ old('case_number') }}" autofocus>

                <input type="hidden" id="case_number_hidden" value="" name="case_number_hidden">
                <div class="dropdown show " id="case_number_list"></div>

            </div>
            {{ csrf_field() }}

            <div class="col">
                <label for="motor_number">{{ __('Motor number') }}</label>
                <input id="motor_number" type="text" class="form-control{{ $errors->has('motor_number') ? ' is-invalid' : '' }}" name="motor_number" value="{{ old('motor_number') }}" placeholder="Motor number" required autofocus>

                @if ($errors->has('motor_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('motor_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col">
                <label for="chassis_number">{{ __('Chassis number') }}</label>
                <input id="chassis_number" type="text" class="form-control{{ $errors->has('chassis_number') ? ' is-invalid' : '' }}" name="chassis_number" value="{{ old('chassis_number') }}" placeholder="Chassis number" required autofocus>

                @if ($errors->has('chassis_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('chassis_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="year_confirmed">{{ __('Year confirmed') }}</label>
                <select name="year_confirmed" class="form-control">
                    <option value="{{ now()->year}}">{{ now()->year }}</option>
                    <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                    <option value="{{ now()->year - 2 }}">{{ now()->year - 2 }}</option>
                    <option value="{{ now()->year - 3 }}">{{ now()->year - 3 }}</option>
                    <option value="{{ now()->year - 4 }}">{{ now()->year - 4 }}</option>
                    <option value="{{ now()->year - 5 }}">{{ now()->year - 5 }}</option>
                    <option value="{{ now()->year - 6 }}">{{ now()->year - 6 }}</option>
                    <option value="{{ now()->year - 7 }}">{{ now()->year - 7 }}</option>
                </select>


                @if ($errors->has('year_confirmed'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year_confirmed') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-4">
                <label for="make">{{ __('Make') }}</label>
                <select name="make" class="form-control">
                    <option>TOYOTA</option>
                    <option>HONDA</option>
                    <option>HYUNDAI</option>
                </select>

                @if ($errors->has('city'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-4">
                <label for="plate_number">{{ __('Plate number') }}</label>
                <input id="plate_number" type="text" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}" name="plate_number" value="{{ old('plate_number') }}" placeholder="Plate number" required autofocus>

                @if ($errors->has('plate_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('plate_number') }}</strong>
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#case_number').keyup(function(){
                var query = $(this).val();
                if (query != ''){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('RegisterController.fetch') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#case_number_list').fadeIn();
                            $('#case_number_list').html(data);
                        }
                    })
                }
            });
        });

        $(document).on('click', 'li', function(){
            $('#case_number').val($(this).text());
            let y = $(this).val();
            $('#case_number_hidden').attr('value', y);
            $('#case_number_list').fadeOut();
            // alert(y)
        });
    </script>
@endsection