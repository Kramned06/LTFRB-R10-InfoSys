<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Operator;
use App\Notification;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $operator = new Franchise([
            'operator_id' => $request->get('operator_id'),
            'case_number' => $request->get('case_number'),
            'business_address' => $request->get('business_address'),
            'date_granted' => $request->get('date_granted'),
            'expiry_date' => $request->get('expiry_date'),
            'route_name' => $request->get('route_name'),
            'deno' => $request->get('deno'),
            'authorize_units' => $request->get('authorize_units'),
            'remarks' => $request->get('remarks'),
        ]);

        $operator->save();

        return back()
            ->with('success', 'You have successfully added franchise.');
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
        $operator = Operator::find($id);
        $operator->firstname = $request->get('firstname');
        $operator->middlename = $request->get('middlename');
        $operator->surname = $request->get('surname');
        $operator->email = $request->get('email');
        $operator->street = $request->get('street');
        $operator->barangay = $request->get('barangay');
        $operator->city = $request->get('city');
        $operator->country = $request->get('country');
        $operator->state = $request->get('state');
        $operator->post_code = $request->get('post_code');
        $operator->contact_number = $request->get('contact_number');
        $operator->contact_number_two = $request->get('contact_number_two');
        $operator->remarks = $request->get('remarks');

        $operator->save();

        return back()
            ->with('Success', 'You have successfully updated operator.');
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

        $notification = Notification::find($id);

        $notification->delete();

        return back();
    }

    public function search(Request $request)
    {
        if ($request->get('search') != '') {

            $operator = DB::table('operators')
                ->where('surname', 'like', '%' . $request->get('search') . '%')
                ->orWhere('middlename', 'like', '%' . $request->get('search') . '%')
                ->orWhere('firstname', 'like', '%' . $request->get('search') . '%')
                ->orWhere('contact_number', 'like', '%' . $request->get('search') . '%')
                ->orWhere('contact_number_two', 'like', '%' . $request->get('search') . '%')
                // ->get();
                ->orderBy('updated_at', 'desc')->paginate(20);

            return view('inspect-home', compact('operator'));

        } else {

            $operator = DB::table('operators')->orderBy('updated_at', 'desc')->paginate(20);
            return view('inspect-home', compact('operator'));
        }

    }
}
