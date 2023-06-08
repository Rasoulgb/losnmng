<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    //
    public function index()
    {
        view('loan.create');
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Bank::where('title', 'LIKE', '%' . $query . '%')->get();
        foreach ($filterResult as $result) {
            $results[] = [
                'id' => $result->id,
                'name' => $result->title
            ];
        }

        return response()->json($results);
    }
}
