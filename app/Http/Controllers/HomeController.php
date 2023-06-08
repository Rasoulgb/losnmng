<?php
namespace  App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $viewData = [];
        // $viewData["title"] = "Home Page - Loan Manager";
        // $viewData["subtitle"] = "Show Loans - Loan Manager";
        // return view('loan.index')->with("viewData", $viewData);
       return redirect()->route('loan.index');
    }
    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About us - Loan Manager";
        $viewData["subtitle"] = "About us";
        $viewData["description"] = "This is an about page ...";
        $viewData["author"] = "Developed by: RasoulGB";
        return view('welcome')->with("viewData", $viewData);
    }
}