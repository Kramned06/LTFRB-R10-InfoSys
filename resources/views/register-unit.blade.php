@extends('layouts.register-app')

@section('content')

    {{-- DETAILS --}}
    @foreach ($unit as $user)
        <div class="modal fade bd-example-modal-lg" id="view_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Unit Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="row">
                                <div class="form-group col">
                                    <label>Case number</label>
                                    <input type="text" class="form-control" placeholder="{{$user->case_number}}" readonly>
                                </div>
                                <div class="form-group col">
                                    <label>Motor number</label>
                                    <input type="text" class="form-control" placeholder="{{$user->motor_number}}" readonly>
                                </div>
                                <div class="form-group col">
                                    <label>Chassis number</label>
                                    <input type="text" class="form-control" placeholder="{{$user->chassis_number}}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Year confirmed</label>
                                    <input type="text" class="form-control" placeholder="{{$user->year_confirmed}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Make</label>
                                    <input type="text" class="form-control" placeholder="{{$user->make}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>plate_number</label>
                                    <input type="text" class="form-control" placeholder="{{$user->plate_number}}" readonly>
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
    @foreach ($unit as $user)
        <form method="POST" action="{{ action('RegisterController@updateUnit', $user->id) }}" autocomplete="off">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_update{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Unit Update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Motor number</label>
                                        <input type="text" class="form-control{{ $errors->has('motor_number') ? ' is-invalid' : '' }}" name="motor_number" value="{{$user->motor_number}}" required autofocus autocomplete="none">

                                        @if ($errors->has('motor_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('motor_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col">
                                        <label>Chassis number</label>
                                        <input type="text" class="form-control{{ $errors->has('chassis_number') ? ' is-invalid' : '' }}" name="chassis_number" value="{{$user->chassis_number}}" required autofocus autocomplete="none">

                                        @if ($errors->has('chassis_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chassis_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>Case number</label>
                                        <input id="case_number{{$user->id}}" type="text" class="form-control" name="case_number" value="{{$user->case_number}}" autofocus autocomplete="off">

                                        <input type="hidden" id="case_number_hidden{{$user->id}}" value="" name="case_number_hidden">
                                        <div class="dropdown show " id="case_number_list{{$user->id}}"></div>
                                    </div>
                                    {{ csrf_field() }}

                                    <div class="form-group col-4">
                                        <label>Plate number</label>
                                        <input type="text" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}" name="plate_number" value="{{$user->plate_number}}" required autofocus autocomplete="none">

                                        @if ($errors->has('plate_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('plate_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-2">
                                        <label>Year confirmed</label>
                                        <input type="text" class="form-control{{ $errors->has('year_confirmed') ? ' is-invalid' : '' }}" name="year_confirmed" value="{{$user->year_confirmed}}" required autofocus autocomplete="none">

                                        @if ($errors->has('year_confirmed'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('year_confirmed') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Make</label>
                                        <input type="text" class="form-control{{ $errors->has('make') ? ' is-invalid' : '' }}" name="make" value="{{$user->make}}" required autofocus>

                                        @if ($errors->has('make'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('make') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Remarks</label>
                                        <textarea class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" rows="3">{{$user->remarks}}</textarea>
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
                    $("#case_number{{$user->id}}").keyup(function(){
                        var query = $(this).val();
                        if (query != ''){
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url:"{{ route('RegisterController.fetchtwo') }}",
                                method:"POST",
                                data:{query:query, _token:_token},
                                success:function(data){
                                    $('case_number_list{{$user->id}}').fadeIn();
                                    $('#case_number_list{{$user->id}}').html(data);
                                }
                            })
                        }
                    });
                });
                
                $(document).on('click', 'li', function(){
                    $("#case_number{{$user->id}}").val($(this).text());
                    let y = $(this).val();
                    $('#case_number_hidden{{$user->id}}').attr('value', y);
                    $('#case_number_list{{$user->id}}').fadeOut();
                });
        </script>
    @endforeach

    {{-- DELETE --}}
    @foreach ($unit as $user)
        {{-- <form method="get" action="{{ action('RegisterController@destroyUnit', $user->id) }}">@csrf --}}
        <form method="GET" action="{{ url('unit', $user->id) }}">@csrf
        {{-- <form action=""></form> --}}
            <div class="modal fade bd-example-modal-lg" id="view_delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Delete unit</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- <p><strong>{{$user->id}}</strong></p> --}}
                            <p>Are you sure you want to delete unit with chassis number <strong>{{$user->chassis_number}} ?</strong></p>
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

    {{-- MAIN --}}
    <div class="container">
        <form method="POST" action="{{ route('RegisterController.searchUnit') }}" autocomplete="off"> @csrf

            <div class="row">
                <div class="form-group col-4">
                    <ul class="nav nav-tabs">

                        @if (Auth::user()->role == 2)
                            <li class="nav-item"><a class="nav-link" href="{{ url('/inspect-home')}}">Operator</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/unit')}}">Unit</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/notification')}}">Notification</a></li>

                        @elseif (Auth::user()->role == 3)
                            <li class="nav-item"><a class="nav-link" href="{{ url('/franchise-home')}}">Franchise</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/register-home')}}">Operator</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/unit')}}">Unit</a></li>

                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ url('/register-home')}}">Operator</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/unit')}}">Unit</a></li>
                        @endif
                        
                    </ul>
                </div>
                
                <div class="form-group col-8">
                    <h4 class="text-right"><strong>Units Records</strong></h4>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col">
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary my-2 my-sm-0 mr-sm-2 btn-sm" onclick="window.location='{{ url('/addUnit') }}'">Add Unit</button>
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

            </div>

            <div class="" style="margin-top:15px;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Case number</th>
                            <th>Motor number</th>
                            <th>Chassis number</th>
                            <th>Plate number</th>
                            <th>Make</th>
                            <th style="width: 255px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach ($unit as $user)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$user->case_number}}</td>
                                <td>{{$user->motor_number}}</td>
                                <td>{{$user->chassis_number}}</td>
                                <td>{{$user->plate_number}}</td>
                                <td>{{$user->make}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_update{{$user->id}}">Update</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#view_{{$user->id}}">Details</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#view_delete{{$user->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {!! $unit->links(); !!}
                </ul>
            </nav>
        </form>
    </div>
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
