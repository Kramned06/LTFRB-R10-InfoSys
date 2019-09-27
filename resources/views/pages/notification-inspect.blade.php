@extends('layouts.inspect-app')

@section('content')
    {{-- DETAILS --}}
    @foreach ($inspect as $user)
        <div class="modal fade bd-example-modal-lg" id="view_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Franchise and Unit details</strong></h5>
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
                                <div class="form-group col-6">
                                    <label>Business address</label>
                                    <input type="text" class="form-control" value="{{$user->motor_number}}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label>Business address</label>
                                    <input type="text" class="form-control" value="{{$user->chassis_number}}" readonly>
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

    {{-- DELETE --}}
    @foreach ($inspect as $user)
        {{-- <form method="get" action="{{ action('InspectionController@destroy', $user->id) }}">@csrf --}}
        <form method="GET" action="{{ url('notification', $user->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Delete notification</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete <br><strong>{{$user->plate_number}} ?</strong></p>
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
        <form method="POST">@csrf
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
            <div class="row">
                <div class="form-group col-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/inspect-home')}}">Operator</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/unit')}}">Unit</a></li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/notification')}}">Notification</a>
                            
                        </li>
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/captured')}}">Captured</a></li> --}}
                    </ul>
                </div>
                <div class="form-group col-8">
                    <h4 class="text-right"><strong>Notified Units</strong></h4>
                </div>
            </div>

            <div class="" style="margin-top:15px;" id="sample">

            </div>
            
        </form>
        
    </div>
@endsection

@section('script')
    <script>
        var auto_refresh = setInterval(
            function(){
                $('#sample').load('<?php echo url('masaya'); ?>').fadeIn("slow");
            },500);
    </script>
@endsection
