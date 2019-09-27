@extends('layouts.inspect-app')

@section('content')
    {{-- DETAILS --}}
    @foreach ($operator as $user)
        <div class="modal fade bd-example-modal-lg" id="view_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Operator Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder="{{$user->firstname}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Middle name</label>
                                    <input type="text" class="form-control" placeholder="{{$user->middlename}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Surname</label>
                                    <input type="text" class="form-control" placeholder="{{$user->surname}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Address</label>
                                    <input type="text" class="form-control"  placeholder="{{$user->street}} {{$user->barangay}} {{$user->city}} {{$user->state}} {{$user->post_code}} {{$user->country}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="{{$user->email}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Contact number (#1)</label>
                                    <input type="text" class="form-control" placeholder="{{$user->contact_number}}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Contact number (#2)</label>
                                    <input type="text" class="form-control" placeholder="{{$user->contact_number_two}}" readonly>
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
    @foreach ($operator as $user)
        <form method="POST" action="{{ action('InspectionController@update', $user->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_update{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Operator Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>First name</label>
                                        <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{$user->firstname}}" autofocus>

                                        @if ($errors->has('firstname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Middle name</label>
                                        <input type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{$user->middlename}}" autofocus>

                                        @if ($errors->has('middlename'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('middlename') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Surname</label>
                                        <input type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{$user->surname}}" autofocus>

                                        @if ($errors->has('surname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Street</label>
                                        <input type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" value="{{$user->street}}" autofocus>

                                        @if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>Barangay</label>
                                        <input type="text" class="form-control{{ $errors->has('barangay') ? ' is-invalid' : '' }}" name="barangay" value="{{$user->barangay}}" autofocus>

                                        @if ($errors->has('barangay'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('barangay') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>City</label>
                                        <input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{$user->city}}" autofocus>

                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Country</label>
                                        <input type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{$user->country}}" autofocus>

                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>State</label>
                                        <input type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{$user->state}}" autofocus>

                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col">
                                        <label>Postal code</label>
                                        <input type="text" class="form-control{{ $errors->has('post_code') ? ' is-invalid' : '' }}" name="post_code" value="{{$user->post_code}}" autofocus>

                                        @if ($errors->has('post_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('post_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Contact #1</label>
                                        <input type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{$user->contact_number}}" autofocus>

                                        @if ($errors->has('contact_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Contact #2</label>
                                        <input type="text" class="form-control{{ $errors->has('contact_number_two') ? ' is-invalid' : '' }}" name="contact_number_two" value="{{$user->contact_number_two}}" autofocus>

                                        @if ($errors->has('contact_number_two'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_number_two') }}</strong>
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
    @endforeach

    {{-- DELETE --}}
    @foreach ($operator as $user)
        <form method="get" action="{{ action('RegisterController@destroy', $user->id) }}">@csrf
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
                            <p>Are you sure you want to delete <br><strong>{{$user->firstname}} {{$user->middlename}} {{$user->surname}} ?</strong></p>
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
        <form method="POST" action="{{ route('InspectionController.search') }}" >@csrf
            <div class="row">
                <div class="form-group col-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="{{ url('/inspect-home')}}">Operator</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/unit')}}">Unit</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/notification')}}">Notification</a></li>
                    </ul>
                </div>
                <div class="form-group col-8">
                    <h4 class="text-right"><strong>Operators Records</strong></h4>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-9">
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary my-2 my-sm-0 mr-sm-2 btn-sm" onclick="window.location='{{ url('/addOperator') }}'">Add Operator</button>
                        <button class="btn btn-success my-2 my-sm-0 mr-sm-2 btn-sm" type="submit">Search</button>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control mr-sm-2" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <button class="btn btn-light my-2 my-sm-0 mr-sm-2 btn-sm" type="submit" value=" ">View All</button>
                    </div>
                </div>
            </div>

            <div class="" style="margin-top:15px;">
                <div class="col">
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
                </div>
                <table class="table table-hover table-border">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Surname</th>
                            <th>Contact #1</th>
                            <th>Contact #2</th>
                            <th style="width: 255px;"></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach ($operator as $user)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->middlename}}</td>
                                <td>{{$user->surname}}</td>
                                <td>{{$user->contact_number}}</td>
                                <td>{{$user->contact_number_two}}</td>
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
                    {!! $operator->links(); !!}
                </ul>
            </nav>
        </form>
    </div>

@endsection
