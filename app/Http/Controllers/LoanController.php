<?php

namespace App\Http\Controllers;

use App\Charts\larapex;
use Carbon\Carbon;
use App\Enums\Role;
use App\Models\Loan;
use App\Models\User;
use App\Models\Instalment;

use Illuminate\Http\Request;
use App\Charts\loanChartChartjs;
use App\Http\Requests\loanStoreRequest;
use Illuminate\Contracts\Session\Session;

class LoanController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Loan::class,'loan');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function report(User $user, Larapex $chart)
    {

        // $userLoans = Loan::whereBelongsTo($user)->get();

        // $total =   Instalment::whereBelongsTo($userLoans)->sum('amount');

        // $Paid = Instalment::whereBelongsTo($userLoans)->Paid()->sum('amount');
        // $remind = $total - $Paid;

        // $Paid=value($Paid);
        // $total=value($total);
        // $Chart = new loanChartChartjs;
        // $Chart->labels(['Total', 'Paid', 'Remind']);
        // $Chart->dataset('Loan Status', 'pie', [$total,  $Paid, $remind]);

        // $data['title'] = 'loan Report';
        // $data['subTitle'] = 'Subtitle';
        // $data['dataset1'] = [$total, $Paid, $remind];
        // $data['labels'] = ['total', 'Paid', 'remind'];
        return view('user.report', ['chart' => $chart->build($user)]);
        // return view('user.loanreport', compact('Chart'));
    }

    public function   userLoans(Request $request, User $user)
    {
    }

    public function index(Request $request)
    {

        $payDetails = [];
        $viewData = [];
        $viewData["title"] = "Loan List";
        $viewData["subtitle"] = "List of Loans";
        // var_dump($request);
        $perpage = request()->perpage;

        if (!($perpage == 1 or $perpage == 5 or $perpage == 10 or $perpage == 20 or $perpage == 30 or $perpage == 50)) {
            $perpage = 5;
        }
        // $perpage<1 ? $perpage=5 : $perpage=request()->perpage;

        if (request()->user()->isAdmin()) {
            $loans = loan::paginate($perpage);
            $loans->appends(['perpage' => $perpage]);
        } else
            $loans = loan::where('user_id', request()->user()->id)->paginate($perpage);
        // dd ($loans);            
        $viewData["loans"] = $loans;
        foreach ($loans as $key => $loan) {
            $id = $loan->id;
            $user = $loan->user->name;
            // dd($user);
            $total =   Instalment::where('loan_id', $id)->count('amount');
            $totalPaid = Instalment::where('loan_id', $id)->Paid()->count('amount');
            $remind = $total - $totalPaid;
            $payDetails[$id] = ['total' => $total, 'totalPaid' => $totalPaid, 'remind' => $remind, 'user' => $user];
        }
        // dd($payDetails);

        return view('loan.index')->with(["viewData" => $viewData, 'payDetails' => $payDetails, 'perpage' => $perpage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Request $request)
    {
        //

        $viewData = [];
        $viewData["title"] = "create Loan";
        $viewData["subtitle"] = "Create Loan";
        $viewData['id'] = $user->id;
        $viewData['name'] = $user->name;
        $viewData['email'] = $user->email;
        $viewData['loan_code'] = "$user->id" . random_int(1000000000000000, 9999999999999999);

        $request->session()->put('loan_code', $viewData['loan_code']);
        session(['user_id' => $user->id]);

        //  dd($viewData);
        return view('loan.create')->with("viewData", $viewData);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(loanStoreRequest $request)
    {



        // $valid_data['user_id']=$request->session()->get('user_id');
        // $valid_data['loan_code']=$request->session()->get('loan_code');
        $request->mergeIfMissing(['user_id' => $request->session()->get('user_id')]);
        $request->mergeIfMissing(['loan_code' => $request->session()->get('loan_code')]);
        //  dd( $request);
        $loan = Loan::create($request->all());
        // dd($loan);

        $sd = Carbon::parse($request->input('start_date'));


        for ($i = 1; $i - 1 < $request->input('number_of_instalments'); $i++) {

            $sd->addMonths();
            $newinstalment = new Instalment();
            $newinstalment->date = $sd;
            $newinstalment->amount = $request->input('amount');
            $newinstalment->loan_id = $loan->id;
            $newinstalment->paid_amount = 0;
            $newinstalment->save();
        }
        return redirect()->route('loan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {


        $viewData = [];
        $viewData["title"] = "Loan";
        $viewData["subtitle"] = "Loan Detailes";
        $viewData["id"] = $loan->user->id;
        $viewData["name"] = $loan->user->name;
        $viewData["email"] = $loan->user->email;
        $viewData["loan_code"] = $loan->loan_code;
        $viewData["loan_id"] = $loan->id;
        $viewData["reciver"] = $loan->reciver;
        $viewData["amount"] = $loan->amount;
        $viewData["start_date"] = $loan->start_date;
        $viewData["number_of_instalments"] = $loan->number_of_instalments;
        $viewData["reminder"] = $loan->reminder;
        $viewData["what_time"] = $loan->what_time;
        $viewData["how_many_days_earlier"] = $loan->how_many_days_earlier;
        $viewData["each_instalments_amount"] = Instalment::where('loan_id', $loan->id)->first()->amount;;

        $total =   Instalment::where('loan_id', $loan->id)->sum('amount');
        $totalPaid = Instalment::where('loan_id', $loan->id)->Paid()->sum('amount');
        $remind = $total - $totalPaid;
        $viewData["total"] =  $total;
        $viewData["totalPaid"] = $totalPaid;
        $viewData["remind"] = $remind;
        return view('loan.show')->with("viewData", $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        $viewData = [];
        $title = "Edit List";
        $subtitle = "Edit Loan";
        //   $loans = loan::where('id', $loan->id)->orderBy('id')->get();
        //dd($loans);
        return view('loan.edit', compact('subtitle', 'title', 'viewData', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {

        $loan->update($request->all());

        return redirect()->route('loan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loan.index')->with('message', 'loan has been Deleted Successfuly');
    }

    // public function showdelete($id)
    // {

    //     $viewData = [];
    //     $viewData["title"] = "Delete Loan";
    //     $viewData["subtitle"] = "Delete Loan";
    //     $viewData["loans"] = Loan::findOrFail($id);
    //     return view('loan.delete')->with("viewData", $viewData);
    // }
}
