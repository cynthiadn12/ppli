<?php

namespace App\Http\Controllers;

use App\SLocation;
use App\FLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class SLocationManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $slocations = DB::table('tb_loc_lvl2')
            ->leftJoin('tb_loc_lvl1', 'tb_loc_lvl2.id_loc_lvl1', '=', 'tb_loc_lvl1.id')
            ->select('tb_loc_lvl2.*', 'tb_loc_lvl1.loc_lvl1 as loc_lvl1_name', 'tb_loc_lvl1.id as loc_lvl1_id')
            ->paginate(5);

        return view('slocation-mgmt/index', ['slocations' => $slocations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flocations = FLocation::all();
        return view('slocation-mgmt/create', ['flocations' => $flocations]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FLocation::findOrFail($request['loc_lvl1_id']);
        $this->validateInput($request);
        SLocation::create([
            'loc_name' => $request['loc_name'],
            'id_loc_lvl1' => $request['loc_lvl1_id']
        ]);

        return redirect()->intended('/slocation-management');
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
        $slocation = SLocation::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($slocation == null || count($slocation) == 0) {
            return redirect()->intended('/slocation-management');
        }

        $flocations = FLocation::all();
        return view('slocation-mgmt/edit', ['slocation' => $slocation, 'flocations' => $flocations]);
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
        $slocation = SLocation::findOrFail($id);
        $this->validate($request, [
            'loc_name' => 'required|max:60'
        ]);
        $input = [
            'loc_name' => $request['loc_name'],
            'id_loc_lvl1' => $request['loc_lvl1_id']
        ];
        SLocation::where('id', $id)->update($input);

        return redirect()->intended('slocation-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SLocation::where('id', $id)->delete();
        return redirect()->intended('slocation-management');
    }

    public function loadSlocation($flocationId) {
        $slocation = SLocation::where('id_loc_lvl1', '=', $flocationId)->get(['id', 'loc_lvl1']);

        return response()->json($slocation);
    }


    private function validateInput($request) {
        $this->validate($request, [
            'loc_name' => 'required|max:60|unique:tb_loc_lvl2'
        ]);
    }

}
