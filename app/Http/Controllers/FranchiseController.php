<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Franchise;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class FranchiseController extends Controller
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

        $validator = Validator::make($request->all(), [
            'years_granted' => 'required|numeric|min:1|not_in:0',
            'authorize_units' => 'required|numeric|min:1|not_in:0'
        ]);

        if ($validator->fails()) {

            return back()->withErrors('Double check if years granted and authorize units is integer.');

        } else {

            $check = $request->get('case_number');

            $franchise = DB::table('franchises')
                ->where('case_number', 'like', '%' . $check . '%')
                ->get();

            if ($franchise->isEmpty()) {

                $date_granted = $request->get('date_granted');
                $years_granted = $request->get('years_granted');
                $get_date_granted = $date = new Carbon($date_granted);
                $date_granted_year = $get_date_granted->format('Y');
                $date_granted_month = $get_date_granted->format('m');
                $date_granted_day = $get_date_granted->format('d');
                $number_of_years = $date_granted_year + $years_granted;
                $expiry_date = $number_of_years . '-' . $date_granted_month . '-' . $date_granted_day;

                $operator = new Franchise([
                    'operator_id' => $request->get('operator_name_hidden'),
                    'case_number' => $request->get('case_number'),
                    'business_address' => $request->get('business_address'),
                    'date_granted' => $request->get('date_granted'),
                    'expiry_date' => $expiry_date,
                    'route_name' => $request->get('route_name'),
                    'deno' => $request->get('deno'),
                    'authorize_units' => $request->get('authorize_units'),
                    'remarks' => $request->get('remarks'),
                ]);

                $operator->save();
                return back()
                    ->with('success', 'You have successfully added franchise.');

            } else {

                return back()
                    ->withErrors('Bogo ga exist na siya ui');

            }
        }
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
        $validator = Validator::make($request->all(), [
            'years_granted' => 'required|numeric|min:1|not_in:0',
        ]);
        
        if ($validator->fails()) {

            return back()->withErrors('Double check if years granted and authorize units is integer.');

        } else {

            $date_granted = $request->get('date_granted');
            $years_granted = $request->get('years_granted');
            $get_date_granted = $date = new Carbon($date_granted);
            $date_granted_year = $get_date_granted->format('Y');
            $date_granted_month = $get_date_granted->format('m');
            $date_granted_day = $get_date_granted->format('d');
            $number_of_years = $date_granted_year + $years_granted;
            $expiry_date = $number_of_years . '-' . $date_granted_month . '-' . $date_granted_day;            

            $franchise = Franchise::find($id);
            $franchise->case_number = $request->get('case_number');
            $franchise->operator_id = $request->get('operator_id_hidden');
            $franchise->business_address = $request->get('business_address');
            $franchise->date_granted = $request->get('date_granted');
            $franchise->expiry_date = $expiry_date;
            $franchise->deno = $request->get('deno');
            $franchise->authorize_units = $request->get('authorize_units');
            $franchise->route_name = $request->get('route_name');
            $franchise->remarks = $request->get('remarks');

            $franchise->save();

            return back()
                ->with('Success', 'You have successfully updated operator.');
            
        }

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
        $franchise = Franchise::find($id);

        $franchise->delete();

        return back();
    }

    public function search(Request $request)
    {

        if ($request->get('search') != '') {

            $search = $request->get('search');

            $operator = DB::table('operators')
                ->where('firstname', 'like', '%' . $search . '%')
                ->orWhere('middlename', 'like', '%' . $search . '%')
                ->orWhere('surname', 'like', '%' . $search . '%')
                ->get();

            if ($operator->isEmpty()) {
                
                $franchise = DB::table('franchises')
                    ->where('case_number', 'like', '%' . $search . '%')
                    ->get();

                if ($franchise->isEmpty()) {

                    return back();
                    
                } else {

                    // $franchise = DB::table('operators')
                    //     ->join('franchises', function ($join) use ($search) {
                    //         $join->on('operators.id', '=', 'franchises.operator_id')
                    //             ->where('case_number', 'like', '%' . $search . '%');
                    //     })
                    //     ->orderBy('franchises.created_at', 'desc')->paginate(20);

                    // return view('franchise-home', compact('franchise'));
                    $franchise = DB::table('franchises')
                        ->leftJoin('operators', 'franchises.operator_id', '=', 'operators.id')
                        ->select('franchises.id', 'franchises.case_number', 'franchises.business_address', 'franchises.date_granted', 'franchises.expiry_date', 'franchises.route_name', 'franchises.deno', 'franchises.authorize_units', 'franchises.remarks', 'franchises.created_at', 'franchises.updated_at', 'operators.id as oid', 'operators.firstname', 'operators.middlename', 'operators.surname')
                        ->where('case_number', 'like', '%' . $search . '%')
                        ->orderBy('franchises.updated_at', 'desc')
                        ->paginate(20);
                    
                    return view('franchise-home', compact('franchise'));
                }

            } else {

                $franchise = DB::table('franchises')
                    ->leftJoin('operators', 'franchises.operator_id', '=', 'operators.id')
                    ->select('franchises.id', 'franchises.case_number', 'franchises.business_address', 'franchises.date_granted', 'franchises.expiry_date', 'franchises.route_name', 'franchises.deno', 'franchises.authorize_units', 'franchises.remarks', 'franchises.created_at', 'franchises.updated_at', 'operators.id as oid', 'operators.firstname', 'operators.middlename', 'operators.surname')
                    ->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('middlename', 'like', '%' . $search . '%')
                    ->orWhere('surname', 'like', '%' . $search . '%')
                    ->orderBy('franchises.updated_at', 'desc')
                    ->paginate(20);

                return view('franchise-home', compact('franchise'));
            }


        } else {

            // $franchise = DB::table('operators')
            //     ->join('franchises', 'operators.id', '=', 'franchises.operator_id')
            //     ->orderBy('franchises.created_at', 'desc')->paginate(20);

            // return view('franchise-home', compact('franchise'));

            return back();
        }
        

    }
    ##### AJAXXXXXXXXXXXXXXXXXXXXXXXXX
    
    public function fetch(Request $request) {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('operators')
                ->where('firstname', 'like', '%' . $query . '%')
                ->orWhere('middlename', 'like', '%' . $query . '%')
                ->orWhere('surname', 'like', '%' . $query . '%')
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';

            foreach ($data as $row) {
                $output .= '<li class="dropdown-item" value=' . $row->id . '>'. ucfirst($row->surname) .', '. ucfirst($row->firstname) .' '. ucfirst($row->middlename) . '</li>';
            }
            
            $output .= '</ul>';

            echo $output;
        }
    }

}
