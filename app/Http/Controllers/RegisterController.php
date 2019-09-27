<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Operator;
use App\Unit;
use App\Franchise;
use Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operator = DB::table('operators')->get();
        return view('register-home', compact('operator'));
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
        //
        // $this->validate($request, [
        //     'firstname' => 'required', 'string', 'max:255',
        //     'middlename' => 'required', 'string', 'max:255',
        //     'surname' => 'required', 'string', 'max:255',
        //     'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        //     'contact_number' => 'required', 'string', 'max:255',
        //     'password' => 'required', 'string', 'min:6', 'confirmed',
        //     'country' => 'required',
        //     'state' => 'required',
        //     'city' => 'required',
        //     'street' => 'required',
        //     'post_code' => 'required',
        //     'remarks' => 'remarks'
        // ]);

        $operator = new Operator([
            'firstname' => $request->get('firstname'),
            'middlename' => $request->get('middlename'),
            'surname' => $request->get('surname'),
            'street' => $request->get('street'),
            'barangay' => $request->get('barangay'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'state' => $request->get('state'),
            'post_code' => $request->get('post_code'),
            'email' => $request->get('email'),
            'contact_number' => $request->get('contact_number'),
            'contact_number_two' => $request->get('contact_number_two'),
            'remarks' => $request->get('remarks'),
        ]);

        $operator->save();

        return back()
            ->with('success', 'You have successfully register operator.');
    }

    public function storeUnit(Request $request) {

        $query = $request->get('case_number_hidden');

        $franchise = Franchise::select('authorize_units')
            ->where('id', $query)
            ->first();
        $franchise_authorize_units = $franchise->authorize_units;

        $unit_franchise_id = Unit::select('franchise_id')
            ->where('franchise_id', $query)
            ->get();
        $unit_count = count($unit_franchise_id);

        if ($franchise_authorize_units > $unit_count ) {
            // return 'there is still available units';
            $unit = new Unit([
                'franchise_id' => $request->get('case_number_hidden'),
                'year_confirmed' => $request->get('year_confirmed'),
                'motor_number' => $request->get('motor_number'),
                'chassis_number' => $request->get('chassis_number'),
                'plate_number' => $request->get('plate_number'),
                'make' => $request->get('make'),
                'number' => $request->get('plate_number'),
                'remarks' => $request->get('remarks'),
            ]);
            
            $unit->save();

            return back()
                ->with('success', 'You have successfully register operator.');

        } else {

            // return 'too much';
            return back()->withErrors('The authorize units exceed the expectation.');
        }

        // $unit = new Unit([
        //     'franchise_id' => $request->get('case_number_hidden'),
        //     'year_confirmed' => $request->get('year_confirmed'),
        //     'motor_number' => $request->get('motor_number'),
        //     'chassis_number' => $request->get('chassis_number'),
        //     'plate_number' => $request->get('plate_number'),
        //     'make' => $request->get('make'),
        //     'number' => $request->get('plate_number'),
        //     'remarks' => $request->get('remarks'),
        // ]);
        
        
        // $unit->save();

        // return back()
        //     ->with('success', 'You have successfully register operator.');
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

    public function updateUnit(Request $request, $id)
    {

        $a = Unit::select('franchise_id')
            ->where('id', $id)
            ->first();

        $b = Franchise::select('case_number')
            ->where('id', $a->franchise_id)
            ->first();

        // $x = $franchise->case_number;

        if (is_null($b)) {
            // return 'can add case number';

            $unit = Unit::find($id);
            $unit->motor_number = $request->get('motor_number');
            $unit->chassis_number = $request->get('chassis_number');
            $unit->year_confirmed = $request->get('year_confirmed');
            $unit->make = $request->get('make');
            $unit->plate_number = $request->get('plate_number');
            $unit->remarks = $request->get('remarks');
            $unit->save();
            
            $franchise = Unit::select('franchise_id')
                ->where('id', $id)
                ->first();

            $x = $franchise->franchise_id;

            if (is_null($x)) {

                $search = $request->get('case_number');

                $y = Franchise::select('case_number')->where('case_number', $search)->first();
                
                if (is_null($y)) {

                    return back()->withErrors('Case number dont exist!');

                } else {

                    $asa = Franchise::select('id')
                        ->where('case_number', $search)
                        ->first();
                    
                    $maa = $asa->id;

                    $franchise = Franchise::select('case_number')
                        ->where('case_number', $search)
                        ->first();

                    Unit::where('id', $id)
                        ->update([
                            'franchise_id' => $maa
                        ]);
                    
                    return back()
                        ->with('Success', 'You have successfully updated unit.');
                }
                
            } else {

                Franchise::where('id', $franchise->franchise_id)
                    ->update([
                        'case_number' => $request->get('case_number')
                    ]);

                return back()
                    ->with('Success', 'You have successfully updated unit.');
            }
            
        } else {
            // return 'bogo dli mka update';
            $unit = Unit::find($id);
            $unit->motor_number = $request->get('motor_number');
            $unit->chassis_number = $request->get('chassis_number');
            $unit->year_confirmed = $request->get('year_confirmed');
            $unit->make = $request->get('make');
            $unit->plate_number = $request->get('plate_number');
            $unit->remarks = $request->get('remarks');
            $unit->save();

            return back()->withErrors('All input fields are updated except case number!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $operator = Operator::find($id);

        $operator->delete();

        return back();

        // return 'try';
    }

    public function destroyUnit(Request $request, $id)
    {
        $unit = Unit::find($id);

        $unit->delete();

        return back();

        // return 'true';

    }

    public function search(Request $request)
    {
        if ($request->get('search') != '') {

            $operator = DB::table('operators')
                ->where('surname', 'like', '%' . $request->get('search') . '%')
                ->orWhere('middlename', 'like', '%' . $request->get('search') . '%')
                ->orWhere('firstname', 'like', '%' . $request->get('search') . '%')
                // ->get();
                ->orderBy('created_at', 'desc')->paginate(20);

            return view('register-home', compact('operator'));

        } else {

            $operator = DB::table('operators')->orderBy('created_at', 'desc')->paginate(20);
            return view('register-home', compact('operator'));
        }

    }

    public function searchUnit(Request $request)
    {

        if ($request->get('search') != '') {

            $search = $request->get('search');

            $unit = DB::table('units')
                ->where('motor_number', 'like', '%' . $request->get('search') . '%')
                ->orWhere('chassis_number', 'like', '%' . $request->get('search') . '%')
                ->orWhere('make', 'like', '%' . $request->get('search') . '%')
                ->orWhere('plate_number', 'like', '%' . $request->get('search') . '%')
                ->get();

            if ($unit->isEmpty()) {

                $franchise = DB::table('franchises')
                    ->where('case_number', 'like', '%' . $search . '%')
                    ->get();

                if ($franchise->isEmpty()) {

                    // return back();
                    return back()->withErrors('No record found.');

                } else {

                    $unit = DB::table('franchises')
                        ->join('units', function ($join) use ($search) {
                            $join->on('franchises.id', '=', 'units.franchise_id')
                                ->where('case_number', 'like', '%' . $search . '%');
                        })
                        ->orderBy('franchises.created_at', 'desc')->paginate(20);

                    return view('register-unit', compact('unit'));
                }

            } else {

                $unit = DB::table('units')
                    ->leftJoin('franchises', 'franchises.id', '=', 'units.franchise_id')
                    ->select('franchises.id as fid', 'franchises.case_number', 'units.motor_number', 'units.chassis_number', 'units.year_confirmed', 'units.make', 'units.id', 'units.plate_number', 'units.remarks')
                    ->where('motor_number', 'like', '%' . $search . '%')
                    ->orWhere('chassis_number', 'like', '%' . $search . '%')
                    ->orWhere('make', 'like', '%' . $search . '%')
                    ->orWhere('plate_number', 'like', '%' . $search . '%')
                    ->orderBy('units.updated_at', 'desc')
                    ->paginate(20);

                return view('register-unit', compact('unit'));
            }

        } else {

            return back();
        }

        
    }
    ##### AJAXXXXXXXXXXXXXXXXXXXXXXXXX

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('franchises')
                ->where('case_number', 'like', '%' . $query . '%')
                ->get();

            $output = '<ul class="dropdown-menu" style="display:block;">';

            foreach ($data as $row) {
                $output .= '<li class="dropdown-item" value=' . $row->id . '>' . $row->case_number . '</li>';
            }

            $output .= '</ul>';

            echo $output;
        }
    }

    public function fetchtwo(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('franchises')
                ->where('case_number', 'like', '%' . $query . '%')
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach ($data as $row) {
                $output .= '<li class="dropdown-item" value=' . $row->id . '>' . $row->case_number . '</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

}
