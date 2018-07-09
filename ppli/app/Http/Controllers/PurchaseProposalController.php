<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Response;
use App\PurchaseProposal;
use App\Sourcing;
use App\Measurement;
use Illuminate\Http\Request;

class PurchaseProposalController extends Controller
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
        $purchases = DB::table('tb_purchase_proposal')
            ->leftJoin('tb_source', 'tb_purchase_proposal.id_source', '=', 'tb_source.id')
            ->leftJoin('tb_measurement', 'tb_purchase_proposal.id_measurement', '=', 'tb_source.id')
            ->select('tb_purchase_proposal.*', 'tb_source.qty as qty_total', 'tb_source.id as id_source', 'tb_measurement.id as id_measurement',
                     'tb_measurement.measurement_name as measurement_name')
            ->paginate(5);

        return view('purchase-proposal/index', ['purchases' => $purchases]);
        $purchase = PurchaseProposal::paginate(5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //var_dump('testing');
        //die();
        $measurements = Measurement::all();
        $sources = Sourcing::all();
        return view('purchase-proposal/create', ['sources' => $sources], ['measurements' => $measurements]);
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
        Sourcing::findOrFail($request['id_source']);
        Measurement::findOrFail($request['id_measurement']);
        PurchaseProposal::create([
            'id_source' => $request['id_source'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'status' => $request['status'],
        ]);

        return redirect()->intended('/purchase-proposal');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = PurchaseProposal::with('source')->find($id);
        return view('purchase-proposal/show', ['purchase' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseProposal::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($purchase == null || count($purchase) == 0) {
            return redirect()->intended('/purchase-proposal');
        }

        return view('purchase-proposal/edit', ['purchase' => $purchase]);
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
        $purchase = PurchaseProposal::findOrFail($id);
        $input = [
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'status' => $request['status'],
        ];
        $this->validate($request, [
            'qty' => 'required|max:60'
        ]);
        PurchaseProposal::where('id', $id)->update($input);

        return redirect()->intended('purchase-proposal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseProposal::where('id', $id)->delete();
        return redirect()->intended('purchase-proposal');
    }


    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    private function validateInput($request) {
        $this->validate($request, [
            'qty' => 'required|max:60'
        ]);
    }

}
