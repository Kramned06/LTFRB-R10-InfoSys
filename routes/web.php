<?php

use Illuminate\Foundation\Auth\AuthenticatesUsers;

Auth::routes();

Route::group(['middleware' => ['web', 'auth', 'loguser']], function(){

    Route::get('/', function () {

        if (Auth::user()->role == 1) {
            $users = DB::table('users')->get();
            return view('profiles.admin-profile', compact('users'));
        }
        if (Auth::user()->role == 2) {
            return view('profiles.inspect-profile');
        }
        if (Auth::user()->role == 3) {
            return view('profiles.franchise-profile');
        }
        if (Auth::user()->role == 4) {
            return view('profiles.register-profile');
        }
        if (Auth::user()->role == 0) {
            Auth::logout();
            return redirect()->to('login')->withErrors('Your account has been confirmed by the admin but no role has signed.');
        }
    });

    Route::get('/admin-home', function () {

        if (Auth::user()->role == 1) {
            $users = DB::table('users')->get();
            return view('admin-home', compact('users'));
        } else {
            return back();
        }
    });

    // Route::get('/admin-home', 'AdminController@index')->name('AdminController.index');

    Route::post('/admin-home/{id}', 'AdminController@updateRole');

    Route::get('/admin-home/{id}', 'AdminController@destroyRole');

    Route::get('/inspect-home', function () {

        if (Auth::user()->role == 2) {

            $operator = DB::table('operators')->orderBy('updated_at', 'desc')->paginate(20);
            return view('inspect-home', compact('operator'));
        
        } elseif (Auth::user()->role == 3) {

            $operator = DB::table('operators')->orderBy('updated_at', 'desc')->paginate(20);
            return view('inspect-home', compact('operator'));

        } elseif (Auth::user()->role == 4) {

            $operator = DB::table('operators')->orderBy('updated_at', 'desc')->paginate(20);
            return view('inspect-home', compact('operator'));

        } else {
            return back();
        }
    });

    Route::post('/inspect-home', 'InspectionController@search')->name('InspectionController.search');

    Route::post('/inspect-home/{id}', 'InspectionController@update');

    Route::get('/inspection', function () {
        if (Auth::user()->role == 2) {

            $unit = DB::table('units')->get();

            $operator = DB::table('operators')->get();

            $franchise = DB::table('franchises')->get();

            return view('pages.addinspection-inspect', compact('unit', 'franchise', 'operator'));
            
        } else {

            return back();
        }

    });

    Route::post('/inspection', 'InspectionController@store');

    Route::get('/notification', function () {
        if (Auth::user()->role == 2) {

            $inspect = DB::table('notifications')
            
                ->leftJoin('franchises', 'franchises.id', '=', 'notifications.franchise_id')
                ->leftJoin('units', 'units.id', '=', 'notifications.unit_id')
                ->select('franchises.id as fid', 'franchises.case_number', 'franchises.authorize_units', 'franchises.deno', 'franchises.route_name', 'franchises.expiry_date', 'franchises.date_granted', 'units.id as uid', 'units.plate_number', 'units.motor_number', 'units.chassis_number', 'units.make', 'notifications.id', 'notifications.remarks', 'notifications.created_at', 'notifications.plate_picture')
                ->orderBy('notifications.created_at', 'desc')
                ->paginate(20);

            return view('pages.notification-inspect', compact('inspect'));

        } else {

            return back();
        }
    });

    Route::get('/notification/{id}', 'InspectionController@destroy');

    Route::get('/captured', function () {
        if (Auth::user()->role == 2) {

            return view('pages.captured-inspect');

        } else {

            return back();
        }
    });

    Route::get('/franchise-home', function () {

        if (Auth::user()->role == 3) {

            $franchise = DB::table('franchises')
                ->leftJoin('operators', 'franchises.operator_id', '=', 'operators.id')
                ->select('franchises.id', 'franchises.case_number', 'franchises.business_address', 'franchises.date_granted', 'franchises.expiry_date', 'franchises.route_name', 'franchises.deno', 'franchises.authorize_units', 'franchises.remarks', 'franchises.created_at', 'franchises.updated_at', 'operators.id as oid', 'operators.firstname', 'operators.middlename', 'operators.surname')
                ->orderBy('franchises.updated_at', 'desc')
                ->paginate(20);
                
            return view('franchise-home', compact('franchise'));

        } else {
            return back();
        }

    });

    Route::post('/franchise-home', 'FranchiseController@search')->name('FranchiseController.search');

    Route::post('/franchise-home/fetchtwo', 'FranchiseController@fetchtwo')->name('FranchiseController.fetchtwo');

    Route::post('/franchise-home/{id}', 'FranchiseController@update');

    Route::get('/franchise-home/{id}', 'FranchiseController@destroy');

    Route::get('/addFranchise', function () {
        if (Auth::user()->role == 3) {
            
            $operator = DB::table('operators')->get();

            return view('pages.addfranchise-franchise', compact('operator'));

        } else {
            return back();
        }

    });

    Route::post('/addFranchise', 'FranchiseController@store');

    Route::post('/addFranchise/fetch', 'FranchiseController@fetch')->name('FranchiseController.fetch');

    Route::get('/register-home', function () {

        if (Auth::user()->role == 4){

            $operator = DB::table('operators')->orderBy('created_at', 'desc')->paginate(20);
            return view('register-home', compact('operator'));

        } elseif (Auth::user()->role == 3) {
            # code...
            $operator = DB::table('operators')->orderBy('created_at', 'desc')->paginate(20);
            return view('register-home', compact('operator'));
        }
        
        else {
            return back();
        }
        
    });


    Route::post('/register-home', 'RegisterController@search')->name('RegisterController.search');

    Route::post('/register-home/{id}', 'RegisterController@update');

    Route::get('/register-home/{id}', 'RegisterController@destroy');

    Route::get('/addOperator', function () {

        if (Auth::user()->role == 4) {
            
            return view('pages.addoperator-register');

        } elseif (Auth::user()->role == 2) {
            
            return view('pages.addoperator-register');
        } elseif (Auth::user()->role == 3) {

            return view('pages.addoperator-register');
        }
        else {
            return back();
        }

    });

    Route::post('/addOperator', 'RegisterController@store');


    Route::get('/unit', function () {
        if (Auth::user()->role == 4) {

            $unit = DB::table('units')
                ->leftJoin('franchises', 'franchises.id', '=', 'units.franchise_id')
                ->select('franchises.id as fid','franchises.case_number', 'units.motor_number', 'units.chassis_number', 'units.year_confirmed', 'units.make', 'units.id', 'units.plate_number', 'units.remarks')
                ->orderBy('units.updated_at', 'desc')
                ->paginate(20);
                
            return view('register-unit', compact('unit'));

        } elseif (Auth::user()->role == 2) {
            
            $unit = DB::table('units')
                ->leftJoin('franchises', 'franchises.id', '=', 'units.franchise_id')
                ->select('franchises.id as fid','franchises.case_number', 'units.motor_number', 'units.chassis_number', 'units.year_confirmed', 'units.make', 'units.id', 'units.plate_number', 'units.remarks')
                ->orderBy('units.updated_at', 'desc')
                ->paginate(20);

            return view('register-unit', compact('unit'));

        } elseif (Auth::user()->role == 3) {

            $unit = DB::table('units')
                ->leftJoin('franchises', 'franchises.id', '=', 'units.franchise_id')
                ->select('franchises.id as fid','franchises.case_number', 'units.motor_number', 'units.chassis_number', 'units.year_confirmed', 'units.make', 'units.id', 'units.plate_number', 'units.remarks')
                ->orderBy('units.updated_at', 'desc')
                ->paginate(20);
            
            // $json = $unit->toJson();
            return view('register-unit', compact('unit'));

        }
        else {
            return back();
        }

    });

    Route::post('/unit', 'RegisterController@searchUnit')->name('RegisterController.searchUnit');

    Route::post('/unit/fetchtwo', 'RegisterController@fetchtwo')->name('RegisterController.fetchtwo');

    Route::post('/unit/{id}', 'RegisterController@updateUnit');

    Route::get('/unit/{id}', 'RegisterController@destroyUnit');

    Route::get('/addUnit', function () {

        if (Auth::user()->role == 4) {

            return view('pages.addunit-register');

        } elseif (Auth::user()->role == 2) {

            return view('pages.addunit-register');

        } elseif (Auth::user()->role == 3) {

            return view('pages.addunit-register');
        } 
        else {

            return back();
        }

    });

    Route::post('/addUnit/fetch', 'RegisterController@fetch')->name('RegisterController.fetch');

    Route::post('/addUnit', 'RegisterController@storeUnit');

    Route::post('/', 'ProfileController@uploadImage');

    Route::post('/{id}', 'ProfileController@update');

});

Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');

Route::post('auth/get_states', 'Auth\RegisterController@get_states');


Route::view('masaya', 'pages.notifications-table', [
    'data' => App\Notification::withFranchisesAndUnits()
]);

