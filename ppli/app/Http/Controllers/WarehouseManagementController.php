<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $warehouses = Warehouse::paginate(5);

        return view('warehouse-mgmt/index', ['warehouses' => $warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse-mgmt/create');
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
        Warehouse::create([
            'name' => $request['name'],
            'location' => $request['location'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'capacity' => $request['capacity'],
        ]);

        return redirect()->intended('/warehouse-management');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($warehouse == null || count($warehouse) == 0) {
            return redirect()->intended('/warehouse-management');
        }

        return view('warehouse-mgmt/edit', ['warehouse' => $warehouse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $constraints = [
            'name' => 'required|max:30',
            'location'=> 'required|max:60'
        ];
        $input = [
            'name' => $request['name'],
            'location' => $request['location'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'capacity' => $request['capacity'],
        ];
        $this->validate($request, $constraints);
        Warehouse::where('id', $id)->update($input);

        return redirect()->intended('/warehouse-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::where('id', $id)->delete();
        return redirect()->intended('/warehouse-management');
    }

    public function search(Request $request) {
    }

    private function doSearchingQuery($constraints) {
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);
    }
}
