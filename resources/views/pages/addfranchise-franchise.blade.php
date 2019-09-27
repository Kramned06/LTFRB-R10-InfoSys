@extends('layouts.franchise-app')

@section('content')
<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <h4><strong>Register Franchise</strong></h4>
        </div>
    </div>
    <form method="POST" action="{{ url('addFranchise') }}">@csrf
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger" style="padding: 10px 10px;border-radius:.25rem;margin-bottom:20px;">
                {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                @foreach ($errors->all() as $error)
                    <strong>Whoops! </strong> {{ $error }}
                @endforeach
                {{-- <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul> --}}
            </div>
        @endif
        
        <div class="row form-group">
            <div class="col-8">
                
                <label for="operator_name">{{ __('Operator') }}</label>
                <input id="operator_name" type="text" class="form-control{{ $errors->has('operator_name') ? ' is-invalid' : '' }}" name="operator_name"  placeholder="Operator name" value="" required autofocus autocomplete="off">
                <input type="hidden" id="operator_name_hidden" value="" name="operator_name_hidden">
                <div class="dropdown show " id="operator_list"></div>
                
            </div>
            {{ csrf_field() }}

            <div class="col-4">
                <label for="case_number">{{ __('Case number') }}</label>
                <input id="case_number" type="text" class="form-control{{ $errors->has('case_number') ? ' is-invalid' : '' }}" name="case_number" value="{{ old('case_number') }}" placeholder="Case number" required autofocus autocomplete="off">

                @if ($errors->has('case_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('case_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-7">
                <label for="business_address">{{ __('Business address') }}</label>
                <input id="business_address" type="text" class="form-control{{ $errors->has('business_address') ? ' is-invalid' : '' }}" name="business_address" value="{{ old('business_address') }}" placeholder="Business address" required autofocus autocomplete="none">

                @if ($errors->has('business_address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('business_address') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-3">
                <label for="date_granted">{{ __('Date granted') }}</label>
                <input id="date_granted" type="date" class="form-control{{ $errors->has('date_granted') ? ' is-invalid' : '' }}" name="date_granted" value="{{ old('date_granted') }}" required autofocus>
            </div>

            <div class="col-2">
                <label>{{ __('Years granted') }}</label>
                <input type="text" class="form-control" name="years_granted" value="{{ old('years_granted') }}" placeholder="Years granted" required autofocus autocomplete="off">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-8">
                <label for="route_name">{{ __('Route name') }}</label>
                <input id="route_name" type="route_name" class="form-control{{ $errors->has('route_name') ? ' is-invalid' : '' }}" name="route_name" value="{{ old('route_name') }}" placeholder="Route name" required autofocus>
                
                @if ($errors->has('route_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('route_name') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="col-2">
                <label>{{ __('Deno.') }}</label>
                <select name="deno" class="form-control">
                    <option value="TX">TX</option>
                    <option value="PUJ">PUJ</option>
                    <option value="SUV">SUV</option>
                    <option value="PUV">PUV</option>
                </select>

            </div>

            <div class="col-2">
                <label for="authorize_units">{{ __('Autho. Units') }}</label>
                <input id="authorize_units" type="text" class="form-control{{ $errors->has('authorize_units') ? ' is-invalid' : '' }}" name="authorize_units" value="{{ old('authorize_units') }}" placeholder="Units" required autofocus autocomplete="off">
                
                @if ($errors->has('authorize_units'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('authorize_units') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col">
                <label for="remarks">{{ __('Remarks') }}</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
                @if ($errors->has('remarks'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('remarks') }}</strong>
                    </span>
                @endif
            </div>
            
        </div>

        <div class="row form-group">
            <div class="col">
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                <button class="btn btn-light"><a href="{{ url('/franchise-home') }}">View all franchises</a></button>
            </div>
        </div>
    </form>
    
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#operator_name').keyup(function(){
                var query = $(this).val();
                if (query != ''){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('FranchiseController.fetch') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#operator_list').fadeIn();
                            $('#operator_list').html(data);
                        }
                    })
                }
            });
        });

        // $(document).on('click', 'li', function(){
        //     $('#operator_name').val($(this).text());
        //     $('#operator_list').fadeOut();
        // });
        
        $(document).on('click', 'li', function(){
            $('#operator_name').val($(this).text());
            let y = $(this).val();
            $('#operator_name_hidden').attr('value', y);
            $('#operator_list').fadeOut();
            // alert(y)
        });

        
    </script>
@endsection