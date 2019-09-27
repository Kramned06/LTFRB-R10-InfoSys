<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile; // new
use App\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        // $user = Auth::user();
        // return view('profiles.register-profile', compact('user', $user));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $user = User::find($id);

        $user->firstname = $request->get('firstname');
        $user->middlename = $request->get('middlename');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->contact_number = $request->get('contact_number');

        $user->save();

        return back()
            ->with('Success', 'You have successfully updated your profile.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage(Request $request){

        $this->validate($request, [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        
        $filename = $user->id . '_avatar' . time() . '.' . request()->select_file->getClientOriginalExtension();
        $filesize = $request->select_file->getClientSize();
        $request->select_file->storeAs('public/UserAvatar', $filename);
        $user->avatar = $filename;
        $user->avatar_size = $filesize;
        $user->save();

        return back()->with('Success', 'You have successfully upload image.');
    }

}
