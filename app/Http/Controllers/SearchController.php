<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function patientSearch(Request $request)
    {
        $request->validate([
            'searchbar' => 'required',
        ]);
        $query = $request->searchbar;
        $patient = DB::table('v_patient')
            ->where('nom', 'ilike', "%$query%")
            ->paginate(10);
        return view("User.index", compact('patient'));
    }
}
