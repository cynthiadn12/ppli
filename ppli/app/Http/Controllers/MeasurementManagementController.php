<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Http\Request;

class MeasurementManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements = Measurement::paginate(5);

        return view('measurement-mgmt/index', ['measurements' => $measurements]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('measurement-mgmt/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        Measurement::create([
            'measurement_name' => $request['measurement_name']
        ]);

        return redirect()->intended('/measurement-management');
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
        $measurement = Measurement::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($measurement == null || count($measurement) == 0) {
            return redirect()->intended('/measurement-management');
        }

        return view('measurement-mgmt/edit', ['measurement' => $measurement]);
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
        $measurement = Measurement::findOrFail($id);
        $input = [
            'measurement_name' => $request['measurement_name']
        ];
        $this->validate($request, [
            'measurement_name' => 'required|max:60'
        ]);
        Measurement::where('id', $id)->update($input);

        return redirect()->intended('measurement-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Measurement::where('id', $id)->delete();
        return redirect()->intended('measurement-management');
    }


    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    private function validateInput($request) {
        $this->validate($request, [
            'measurement_name' => 'required|max:60'
        ]);
    }
}
