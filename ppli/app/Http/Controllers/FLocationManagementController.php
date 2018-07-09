<?php

namespace App\Http\Controllers;

use App\FLocation;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class FLocationManagementController extends Controller
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
        $flocations = FLocation::paginate(5);

        return view('flocation-mgmt/index', ['flocations' => $flocations]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flocation-mgmt/create');
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
        FLocation::create([
            'loc_lvl1' => $request['loc_lvl1'],
        ]);

        return redirect()->intended('/flocation-management');
    }
    /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
        $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
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
        $flocation = FLocation::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($flocation == null || count($flocation) == 0) {
            return redirect()->intended('/flocation-management');
        }

        return view('flocation-mgmt/edit', ['flocation' => $flocation]);
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
        $flocation = FLocation::findOrFail($id);
        $input = [
            'loc_lvl1' => $request['loc_lvl1'],
        ];
        $this->validate($request, [
            'loc_lvl1' => 'required|max:60'
        ]);
        FLocation::where('id', $id)->update($input);

        return redirect()->intended('flocation-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FLocation::where('id', $id)->delete();
        return redirect()->intended('flocation-management');
    }


    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

    }

    private function doSearchingQuery($constraints) {

    }

    private function validateInput($request) {
        $this->validate($request, [
            'loc_lvl1' => 'required|max:60',
        ]);
    }
}
