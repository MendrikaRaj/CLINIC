<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function logAdmin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $user = Admin::where('email', '=', $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                # code...
                $request->session()->put('AdminId', $user->id);
                return redirect('/index');
            } else {
                return back()->with('fail', 'Mot de passe incorrect');
            }
        } else {
            return back()->with('fail', 'Cette Email n\'existe pas dans notre base');
        }
    }

    public function logoutAdmin()
    {
        # code...
        if (Session::has('AdminId')) {
            # code...
            Session::pull('AdminId');
            return redirect('/');
        }
    }
    //----------------------------------------------------------------

    //Employe
    //----------------------------------------------------------------
    public function logEmploye(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $user = Employe::where('email', '=', $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                # code...
                $request->session()->put('EmployeId', $user->id);
                return redirect('/index-employe');
            } else {
                return back()->with('fail', 'Mot de passe incorrect');
            }
        } else {
            return back()->with('fail', 'Cette Email n\'est pas encore enregistrer');
        }
    }

    public function logoutEmploye()
    {
        # code...
        if (Session::has('EmployeId')) {
            # code...
            Session::pull('EmployeId');
            return redirect('/User');
        }
    }
}
