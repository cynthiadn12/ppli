<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Response;
use App\Fish;
use App\FLocation;
use App\Measurement;
use App\SLocation;
use App\Vendor;
use Yajra\Datatables\Datatables;
use App\Sourcing;
use Illuminate\Http\Request;

class SourcingDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sourcings = DB::table('tb_source')
            ->leftJoin('tb_loc_lvl1', 'tb_source.id_loc_lvl1', '=', 'tb_loc_lvl1.id')
            ->leftJoin('tb_loc_lvl2', 'tb_source.id_loc_lvl2', '=', 'tb_loc_lvl2.id')
            ->leftJoin('tb_vendor', 'tb_source.id_vendor', '=', 'tb_vendor.id')
            ->leftJoin('tb_fish', 'tb_source.id_fish', '=', 'tb_fish.id')
            ->leftJoin('tb_measurement', 'tb_source.id_measurement', '=', 'tb_measurement.id')
            ->select('tb_source.*', 'tb_loc_lvl1.id as id_loc_lvl1', 'tb_loc_lvl1.loc_lvl1 as loc_lvl1_name',
                              'tb_loc_lvl2.id as id_loc_lvl2', 'tb_loc_lvl2.loc_name as loc_lvl2_name',
                              'tb_vendor.id as id_vendor', 'tb_vendor.comp_name as vendor_name',
                              'tb_fish.id as id_fish', 'tb_fish.fish_name as fish_name',
                              'tb_measurement.id as id_measurement', 'tb_measurement.measurement_name as measurement_name')
            ->paginate(5);

        return view('sourcings-dshbrd/index', ['sourcings' => $sourcings]);
        $sourcings = Sourcing::paginate(5);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flocations = FLocation::all();
        $slocations = SLocation::all();
        $vendors = Vendor::all();
        $fishes = Fish::all();
        $measurements = Measurement::all();
        return view('sourcings-dshbrd/create', ['flocations' => $flocations,
            'slocations' => $slocations, 'vendors' => $vendors,
            'fishes' => $fishes, 'measurements' => $measurements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FLocation::findOrFail($request['id_loc_lvl1']);
        SLocation::findOrFail($request['id_loc_lvl2']);
        Fish::findOrFail($request['id_fish']);
        Vendor::findOrFail($request['id_vendor']);
        Measurement::findOrFail($request['id_measurement']);
        $this->validateInput($request);
        Sourcing::create([
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ]);

        return redirect()->intended('/sourcing-dashboard');
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
        $sourcing = Sourcing::find($id);

//        if ($sourcing == null || count($sourcing) == 0){
//            return redirect()->intended('/sourcing-dashboard');
//        }
        $flocations = FLocation::all();
        $slocations = SLocation::all();
        $fishes = Fish::all();
        $vendors = Vendor::all();
        $measurements = Measurement::all();
        return view('sourcings-dshbrd/edit', ['sourcing' => $sourcing, 'flocations' => $flocations,
            'slocations' => $slocations, 'fishes' => $fishes, 'vendors' => $vendors, 'measurements' => $measurements]);

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
        $sourcing = Sourcing::findOrFail($id);
        $input = [
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ];
        $this->validate($request, [
             'id_loc_lvl1' => 'required|max:11',
             'id_loc_lvl2' => 'required|max:11',
             'id_vendor' => 'required|max:11',
             'id_fish' => 'required|max:11',
             'id_measurement' => 'required|max:11',
        ]);
        Sourcing::where('id', $id)
            ->update($input);

        return redirect()->intended('sourcing-dashboard');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sourcing::where('id', $id)->delete();
        return redirect()->intended('/sourcing-dashboard');
    }

    public function search(Request $request){
        $constraints = [
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ];

        $sourcings = $this->doSearchingQuery($constraints);
        return view('sourcings-dshbrd/index',['sourcings' => $sourcings, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = Sourcing::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint){
            if ($constraint != null){
                $query = $query->where($fields[$index],'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

    private function validateInput($request){
        $this->validate($request, [
            'id_loc_lvl1' => 'required|max:11',
            'id_loc_lvl2' => 'required|max:11',
            'id_vendor' => 'required|max:11',
            'id_fish' => 'required|max:11',
            'id_measurement' => 'required|max:11',
        ]);
    }

}
