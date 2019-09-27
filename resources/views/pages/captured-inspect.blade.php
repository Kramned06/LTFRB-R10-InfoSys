@extends('layouts.inspect-app')

@section('content')
<div class="container">
    
    {{-- <script src="https://www.gstatic.com/firebasejs/5.7.2/firebase.js"></script>
    <script>
        // Initialize Firebase

        var config = {
            apiKey: "AIzaSyAKCn9Fn6jXQIaiP4d5ndLm49UAvpTY0JI",
            authDomain: "informationsystem-926ad.firebaseapp.com",
            databaseURL: "https://informationsystem-926ad.firebaseio.com",
            projectId: "informationsystem-926ad",
            storageBucket: "informationsystem-926ad.appspot.com",
            messagingSenderId: "677700389634"
        };
        firebase.initializeApp(config);
        
        // #########################################################

        var storage = firebase.storage();

        var imgRef = storage.ref('images/20190901_015535AM.jpg');
        var awww = storage.ref('images/');

        var masaya = imgRef.getDownloadURL().then(function(url) {
            // Insert url into an <img> tag to "download"
            var img = document.getElementById('myimg');
            img.src = url;
        
        });

        console.log(awww);
        
    </script> --}}

    

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
            <div class="form-group">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/inspect-home')}}">Inspect</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/notification')}}">Notification</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/captured')}}">Captured</a></li>
                </ul>
            </div>
        </div>
        @foreach (glob("storage/informationsystem-926ad.appspot.com/images/*.jpg") as $filename)
            <div class="card float-left" style="width: 272px; margin: 1px 1px">
                <img class="card-img-topx" src="{{$filename}}" alt="">
            </div>
        @endforeach
        
    </form>
</div>


@endsection
