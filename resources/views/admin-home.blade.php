@extends('layouts.admin-app')

@section('content')
    {{-- DETAILS --}}
    @foreach ($users as $user)
        <div class="modal fade bd-example-modal-lg" id="view_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-7">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" value="{{$user->surname}}, {{$user->firstname}} {{$user->middlename}}" readonly>
                                </div>
                                <div class="form-group col-5">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-7">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{$user->city}} {{$user->state}} {{$user->postal_code}} {{$user->country}}" readonly>
                                </div>
                                <div class="form-group col-5">
                                    <label>Contact number</label>
                                    <input type="text" class="form-control" value="{{$user->contact_number}}" readonly>
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
    @foreach ($users as $user)
        <form method="post" action="{{ action('AdminController@updateRole', $user->id) }}" >@csrf
            <div class="modal fade bd-example-modal-lg" id="view_update{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Update user role</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-3">
                                    <label class="col-sm-2 col-form-label">User</label>
                                </div>
                                <div class="col-9">
                                    <input  class="form-control" type="text" value="{{ $user->surname }}, {{ $user->firstname }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label class="col-sm-2 col-form-label">Role</label>
                                </div>
                                <div class="col-9">
                                    <select name="role" class="form-control">
                                        {{-- <option value="1">Admin</option> --}}
                                        <option value="2">Inspector</option>
                                        <option value="3">Franchise</option>
                                        <option value="4">Registration</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    {{-- DELETE --}}
    @foreach ($users as $user)
        <form method="get" action="{{ action('AdminController@destroyRole', $user->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Delete user</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to remove user <br><strong>{{$user->firstname}} {{$user->surname}}?</strong></p>
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

    
    <div class="container">
        <form action="">
            {{-- <div class="row">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="{{ url('/admin-home')}}">User</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register-home')}}">Operator</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/unit')}}">Unit</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-9">
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary my-2 my-sm-0 mr-sm-2 btn-sm" onclick="window.location='{{ url('/addUnit') }}'">Add Users</button>
                        <button class="btn btn-success my-2 my-sm-0 mr-sm-2 btn-sm" type="submit">Search</button>

                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control mr-sm-2" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <button class="btn btn-light my-2 my-sm-0 mr-sm-2 btn-sm" type="submit" value=" ">View All</button>
                    </div>
                </div>
                <div class="form-group col-3">
                    <h4 class="text-right"><strong>Users</strong></h4>
                </div>
            </div> --}}
            <div class="form-group col">
                <h4 class="text-right"><strong>Users</strong></h4>
            </div>
            <div class="row justify-content-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width: 255px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if($user->role != '1')
                                <tr>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->middlename}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->role =='1')         
                                        <td>Admin</td> 
                                    @elseif($user->role =='2')
                                        <td>Inspection</td>        
                                    @elseif($user->role =='3')
                                        <td>Franchise</td>        
                                    @elseif($user->role =='4')
                                        <td>Registration</td>        
                                    @else
                                        <td>Unassigned</td>        
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#view_update{{$user->id}}">Update</button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_{{$user->id}}">Details</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#view_delete{{$user->id}}">Delete</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
