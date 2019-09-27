<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ Auth::user()->firstname }}</title>
        <link rel="shortcut icon" href="{{ asset('img/ltfrb.png') }}">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            .emp-profile{
                padding: 3%;
                margin-top: 3%;
                margin-bottom: 3%;
                border-radius: 0.5rem;
                background: #fff;
            }
            .profile-img{
                text-align: center;
            }
            .profile-img img{
                width: 70%;
                height: 100%;
            }
            .profile-img .file {
                position: relative;
                overflow: hidden;
                margin-top: -20%;
                width: 70%;
                border: none;
                border-radius: 0;
                font-size: 15px;
                background: #212529b8;
            }
            .profile-img .file input {
                position: absolute;
                opacity: 0;
                right: 0;
                top: 0;
            }
            .profile-head h5{
                color: #333;
            }
            .profile-head h6{
                color: #0062cc;
            }
            .profile-edit-btn{
                border: none;
                border-radius: 2px;
                /* width: 70%; */
                padding: 7px 7px;
                font-weight: 600;
                color: #6c757d;
                cursor: pointer;
            }
            .proile-created{
                font-size: 12px;
                color: #818182;
                margin-top: 5%;
            }
            .proile-created span{
                color: #495057;
                font-size: 15px;
                font-weight: 600;
            }
            .profile-head .nav-tabs{
                margin-bottom:5%;
            }
            .profile-head .nav-tabs .nav-link{
                font-weight:600;
                border: none;
            }
            .profile-head .nav-tabs .nav-link.active{
                border: none;
                border-bottom:2px solid #0062cc;
            }
            .profile-work{
                padding: 14%;
                margin-top: -15%;
            }
            .profile-work p{
                font-size: 12px;
                color: #818182;
                font-weight: 600;
                margin-top: 10%;
            }
            .profile-work a{
                text-decoration: none;
                color: #495057;
                font-weight: 600;
                font-size: 14px;
            }
            .profile-work ul{
                list-style: none;
            }
            .profile-tab label{
                font-weight: 600;
            }
            .profile-tab p{
                font-weight: 600;
                color: #0062cc;
            }
        </style>
    </head>
    <body>
        {{-- UPDATE --}}
        <form method="POST" action="{{ action('ProfileController@update', Auth::user()->id) }}">@csrf
            <div class="modal fade bd-example-modal-lg" id="view_update{{ Auth::user()->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="firstname">{{ __('Firstname') }}</label>
                                        <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ Auth::user()->firstname }}" placeholder="Firstname" required autofocus>

                                        @if ($errors->has('firstname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="middlename">{{ __('Middlename') }}</label>
                                        <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ Auth::user()->middlename }}" placeholder="Middlename" required autofocus>

                                        @if ($errors->has('middlename'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('middlename') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="surname">{{ __('Surname') }}</label>
                                        <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ Auth::user()->surname }}" placeholder="Surname" required autofocus>

                                        @if ($errors->has('surname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_number">{{ __('Contact') }}</label>
                                        <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{ Auth::user()->contact_number }}" placeholder="Contact" required autofocus>

                                        @if ($errors->has('contact_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_number') }}</strong>
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
        <div class="flex-center position-ref full-height">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Profile</a></li>
                                    <li class="nav-item"><a href="{{ url('/register-home') }}" class="nav-link">Home</a></li>
                                @else
                                    <a href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname }} {{ Auth::user()->surname }} <span class="caret"></span>
                                    </a>
                                    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container emp-profile">
                <div class="row">
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
                <div class="row">
                    <div class="col-4">
                        <div class="profile-img">
                            <form method="POST" action="{{ url('/') }}" enctype="multipart/form-data">@csrf
                                <img src="storage/UserAvatar/{{ Auth::user()->avatar }}" alt="">
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="select_file"/>
                                </div>
                                <div class="">
                                    <button class="btn btn-primary btn-sm" type="submit" name="upload">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="profile-head">
                            <h5>
                                {{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->surname }}
                            </h5>
                            <h6>
                                {{ Auth::user()->address }}
                            </h6>
                            <p class="proile-created">Account Created: <span>{{ Auth::user()->created_at->format('m/d/Y') }}</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Firstname</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->firstname }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Middlename</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->middlename }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Surname</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->surname }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->contact_number }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Role</label>
                                    </div>
                                    <div class="col-md-6">
                                        @if (auth()->user()->role == 1)
                                            <p>Admin</p>
                                        @elseif (auth()->user()->role == 2)
                                            <p>Inspector</p>
                                        @elseif (auth()->user()->role == 3)
                                            <p>Franchise</p>
                                        @elseif (auth()->user()->role == 4)
                                            <p>Register</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#view_update{{ Auth::user()->id}}">Edit Profile</button>
                    </div>
                </div>      
            </div>
        </div>
    </body>
</html>
