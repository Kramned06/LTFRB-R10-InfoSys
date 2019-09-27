@extends('layouts.franchise-app')

@section('content')
    {{-- DETAILS --}}
    @foreach ($franchise as $user)
        <div class="modal fade bd-example-modal-lg" id="view_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Franchise Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col">
                                    <label>Case Number</label>
                                    <input type="text" class="form-control" value="{{$user->case_number}}" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Deno</label>
                                    <input type="text" class="form-control" value="{{$user->deno}}" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Autho. Units</label>
                                    <input type="text" class="form-control" value="{{$user->authorize_units}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Operator</label>
                                    <input type="text" class="form-control" value="{{$user->surname}}, {{$user->firstname}} {{$user->middlename}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Business address</label>
                                    <input type="text" class="form-control" value="{{$user->business_address}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Route name</label>
                                    <input type="text" class="form-control" value="{{$user->route_name}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Date granted</label>
                                    <input type="text" class="form-control" value="{{$user->date_granted}}" readonly>
                                </div>
                                <div class="form-group col">
                                    <label>Expiry date</label>
                                    <input type="text" class="form-control" value="{{$user->expiry_date}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Remarks</label>
                                    <textarea class="form-control" rows="3" placeholder="{{$user->remarks}}"readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- UPDATE --}}
    @foreach ($franchise as $user)
        <form method="POST" action="{{ action('FranchiseController@update', $user->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_update{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="case_number">{{ __('Case number') }}</label>
                                        <input id="case_number" type="text" class="form-control{{ $errors->has('case_number') ? ' is-invalid' : '' }}" name="case_number" value="{{ $user->case_number }}" placeholder="Case number" required autofocus>

                                        @if ($errors->has('case_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('case_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-3">
                                        <label>{{ __('Deno.') }}</label>
                                        <select name="deno" class="form-control">
                                            <option value="{{ $user->deno }}">{{ $user->deno }}</option>
                                            <option value="TX">TX</option>
                                            <option value="PUJ">PUJ</option>
                                            <option value="SUV">SUV</option>
                                            <option value="PUV">PUV</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="authorize_units">{{ __('Autho. Units') }}</label>
                                        <input id="authorize_units" type="authorize_units" class="form-control{{ $errors->has('authorize_units') ? ' is-invalid' : '' }}" name="authorize_units" value="{{ $user->authorize_units }}" placeholder="Autho. Units" required autofocus>
                                        
                                        @if ($errors->has('authorize_units'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('authorize_units') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col">
                                        <label for="operator_id">Operator</label>

                                        <input id="operator_id{{$user->id}}" type="text" class="form-control" name="operator_id" value="{{ucfirst($user->surname)}} {{ucfirst($user->firstname)}} {{ucfirst($user->middlename)}}" autofocus autocomplete="off">

                                        <input type="hidden" id="operator_id_hidden{{$user->id}}" value="" name="operator_id_hidden">
                                        <div class="dropdown show " id="operator_id_list{{$user->id}}"></div>
                                    </div>
                                    {{ csrf_field() }}

                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="business_address">{{ __('Business address') }}</label>
                                        <input id="business_address" type="text" class="form-control{{ $errors->has('business_address') ? ' is-invalid' : '' }}" name="business_address" value="{{ $user->business_address }}" placeholder="Business address" required autofocus>

                                        @if ($errors->has('business_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('business_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="route_name">{{ __('Route name') }}</label>
                                        <input id="route_name" type="route_name" class="form-control{{ $errors->has('route_name') ? ' is-invalid' : '' }}" name="route_name" value="{{ $user->route_name }}" placeholder="Route name" required autofocus>
                                        
                                        @if ($errors->has('route_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('route_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-5">
                                        <label for="date_granted">{{ __('Date granted') }}</label>
                                        <input id="date_granted" type="date" class="form-control{{ $errors->has('date_granted') ? ' is-invalid' : '' }}" name="date_granted" value="{{ date('Y-m-d', strtotime($user->date_granted)) }}" required autofocus>

                                        @if ($errors->has('date_granted'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_granted') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-5">
                                        <label for="expiry_date">{{ __('Expiry date') }}</label>
                                        <input id="expiry_date" type="date" class="form-control{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" name="expiry_date" value="{{ date('Y-m-d', strtotime($user->expiry_date)) }}" readonly>
                                    </div>

                                    <div class="col-2">
                                        <label>{{ __('Years granted') }}</label>
                                        <input type="text" class="form-control" name="years_granted" value="{{ date('Y', strtotime($user->expiry_date)) -date('Y', strtotime($user->date_granted)) }}" placeholder="Years" autofocus autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="remarks">{{ __('Remarks') }}</label>
                                        <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ $user->remarks }}</textarea>
                                        @if ($errors->has('remarks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('remarks') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Update') }}</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#operator_id{{$user->id}}").keyup(function(){
                        var query = $(this).val();
                        if (query != ''){
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url:"{{ route('FranchiseController.fetch') }}",
                                method:"POST",
                                data:{query:query, _token:_token},
                                success:function(data){
                                    $('#operator_id_list{{$user->id}}').fadeIn();
                                    $('#operator_id_list{{$user->id}}').html(data);
                                }
                            })
                        }
                    });
                });
                
                $(document).on('click', 'li', function(){
                    $("#operator_id{{$user->id}}").val($(this).text());
                    let y = $(this).val();
                    $('#operator_id_hidden{{$user->id}}').attr('value', y);
                    $('#operator_id_list{{$user->id}}').fadeOut();
                });
        </script>
    @endforeach

    {{-- DELETE --}}
    @foreach ($franchise as $user)
        <form method="get" action="{{ action('FranchiseController@destroy', $user->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Delete operator</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete <br>CASE NUMBER <strong>{{$user->case_number}} ?</strong></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    
    <form method="POST" action="{{ action('FranchiseController@search') }}" autocomplete="off">@csrf
        <div class="container">
            <div class="row">
                <div class="form-group col-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="{{ url('/franchise-home')}}">Franchise</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register-home')}}">Operator</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/unit')}}">Unit</a></li>
                    </ul>
                </div>

                <div class="form-group col-8">
                    <h4 class="text-right"><strong>Franchise Records</strong></h4>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary my-2 my-sm-0 mr-sm-2 btn-sm" onclick="window.location='{{ url('/addFranchise') }}'">Add Franchise</button>
                        <button class="btn btn-success my-2 my-sm-0 mr-sm-2 btn-sm" type="submit">Search</button>
                        
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control mr-sm-2" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <button class="btn btn-light my-2 my-sm-0 mr-sm-2 btn-sm" type="submit" value=" ">View All</button>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-warning" >
                                <button type="button" class="close" data-dismiss="alert" style="padding-left:10px;">×</button>
                                {{-- <strong>Whoops!</strong> There were no found with your input. {{ $errors }} --}}
                                
                                @foreach ($errors->all() as $error)
                                    <strong>Read me! </strong> {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:15px;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Case Number</th>
                            <th>Operator</th>
                            <th>Date Granted</th>
                            <th>Expiry Date</th>
                            <th>Deno</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach ($franchise as $user)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$user->case_number}}</td>
                                <td>{{ ucfirst($user->surname)}} {{ ucfirst($user->firstname)}} {{ ucfirst($user->middlename)}}</td>
                                <td>{{$user->date_granted}}</td>
                                <td>{{$user->expiry_date}}</td>     
                                <td>{{$user->deno}}</td>     
                                
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#view_update{{$user->id}}">Update</button>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_{{$user->id}}">Details</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#view_delete{{$user->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {!! $franchise->links(); !!}
                </ul>
            </nav>
        </div>
    </form>
@endsection

@section('script')

    {{-- <script type="text/javascript">

            $(document).ready(function(){
                $("#case_number{{$user->id}}").keyup(function(){
                    var query = $(this).val();
                    if (query != ''){
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:"{{ route('RegisterController.fetchtwo') }}",
                            method:"POST",
                            data:{query:query, _token:_token},
                            success:function(data){
                                $('case_number_list').fadeIn();
                                $('#case_number_list').html(data);
                            }
                        })
                    }
                });
            });
            
            $(document).on('click', 'li', function(){
                $("#case_number{{$user->id}}").val($(this).text());
                let y = $(this).val();
                $('#case_number_hidden').attr('value', y);
                $('#case_number_list').fadeOut();
            });
    </script> --}}

@endsection