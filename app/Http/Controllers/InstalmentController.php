<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Instalment;
use Illuminate\Http\Request;

class InstalmentController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function show( Loan $loan)
    {

        
        $viewData = [];
        $viewData["title"] = "Instalment List";
        $viewData["subtitle"] = "List of Instalments";

        if (request()->total == true) {
            $viewData["instalments"] = Instalment::where('loan_id','=', $loan->id)->orderBy('id')
                ->simplePaginate(4);   
                $viewData["instalments"]->appends(['total' => true]);
        } elseif (request()->remind == true){
            $viewData["instalments"] = Instalment::where('loan_id', $loan->id)->NotPaid()->orderBy('id')
                ->simplePaginate(4);
                $viewData["instalments"]->appends(['remind' => true]);
        } elseif (request()->paied == true){
            $viewData["instalments"] = Instalment::where('loan_id', $loan->id)->Paid()->orderBy('id')
                ->simplePaginate(4);
                $viewData["instalments"]->appends(['paied' => true]);
        }

        $total =   Instalment::where('loan_id', $loan->id)->count('amount');
        $totalPaid = Instalment::where('loan_id', $loan->id)->Paid()->count('amount');
        $remind = $total - $totalPaid;

        return view('instalment.show')->with("viewData", $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function edit(Instalment $instalment)
    {
        //
        $viewData = [];
        $viewData["title"] = "Edit Instalment";
        $viewData["subtitle"] = "Edit Instalment";
        $viewData["instalment"] = $instalment;
        return view('instalment.edit')->with("viewData", $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instalment $instalment)
    {
        //
        // dd($request->all());
        // $instalment->update(['paid_date'=>$request->paid_date , 'paid_amount'=>$request->input('paid_amount')]);
        $instalment->update($request->all());
        //  dd($instalment);
        return redirect()->route('loan.show', [$instalment->loan_id,'all'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instalment $instalment)
    {
        //
    }
}
