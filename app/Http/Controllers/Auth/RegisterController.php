<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use DB;
use Mail;
use Illuminate\Http\Request;
use App\CountryState;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->CountryState = new CountryState();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'street' => ['required'],
            'barangay' => ['required'],
            'postal_code' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'password' => Hash::make($data['password']),
            
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'street' => $data['street'],
            'barangay' => $data['barangay'],
            'postal_code' => $data['postal_code'],
        ]);
        
    }

    public function get_states(){

        // dd(Input::get('id'));
        $data['states'] = $this->CountryState->states();
        // dd($data['states']);

        return view('auth.states', $data);
    }

    public function register(Request $request) {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()) {
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);

            DB::table('users_activations')->insert(['user_id' => $user['id'], 'token' => $user['link']]);
            Mail::send('mail.activation', $user, function($message) use ($user) {
                // $message->to($user['email']);
                $message->to('ltfrb.r10infosys@gmail.com');
                $message->subject('LTFRB - User registration verification'. ' ' . $user['email']);
            });
            return redirect()->to('login')->with('Success', 'Your registration is now pending for confirmation.');
        } else {
            return back()->withErrors('Please check your input! Make sure email is unuse.'); 
        }
        
    }

    public function userActivation($token) {
        $check = DB::table('users_activations')->where('token', $token)->first();
        if (!is_null($check)) {
            $user = User::find($check->user_id);
            if ($user->is_activated == 1){
                return redirect()->to('login')->with('Success', "User is already activated");
            }
            $user->update(['is_activated' => 1]);
            DB::table('users_activations')->where('token', $token)->delete();
            return redirect()->to('login')->with('Success', 'User active successfully!');
            
        }
        return redirect()->to('login')->with('Warning', 'your token is invalid');
    }
}
