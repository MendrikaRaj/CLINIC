<?php

namespace App\Http\Controllers;

use App\Models\Acte;
use App\Models\Admin;
use App\Models\Benefice;
use App\Models\Depense;
use App\Models\DepenseMoisAnnee;
use App\Models\Genre;
use App\Models\Mois;
use App\Models\Patient;
use App\Models\PatientActe;
use App\Models\PatientActeDetail;
use App\Models\RealisationDepense;
use App\Models\RealisationRecette;
use App\Models\RecetteMoisAnnee;
use App\Models\TotalDepenseMoisAnnee;
use App\Models\TotalRecetteMoisAnnee;
use App\Models\TypeDepense;
use App\Models\V_Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LinkController extends Controller
{
    ///ADMIN///
    ////////////////////////////////
    public function index()
    {
        if (Session::has('AdminId')) {
            $mois = Mois::all();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $totaleRecette = TotalRecetteMoisAnnee::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            $totaleDepense = TotalDepenseMoisAnnee::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            $realisationRecette = RealisationRecette::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->get();
            $realisationDepense = RealisationDepense::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->get();
            $benefice = Benefice::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            return view("Admin.index", compact('mois', 'totaleRecette', 'totaleDepense', 'realisationRecette', 'realisationDepense', 'benefice'));
        }
        return redirect('/');
    }
    public function dashboard(Request $request)
    {
        if (Session::has('AdminId')) {
            $request->validate([
                'mois' => 'required',
                'annee' => 'required',
            ]);
            $currentMonth = $request->mois;
            $currentYear = $request->annee;
            $mois = Mois::all();
            $totaleRecette = TotalRecetteMoisAnnee::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            $totaleDepense = TotalDepenseMoisAnnee::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            $realisationRecette = RealisationRecette::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->get();
            $realisationDepense = RealisationDepense::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->get();
            $benefice = Benefice::where('month', '=', $currentMonth)
                ->where('year', '=', $currentYear)
                ->first();
            return view("Admin.index", compact('mois', 'totaleRecette', 'totaleDepense', 'realisationRecette', 'realisationDepense', 'benefice'));
        }
        return redirect('/');
    }

    public function p_register()
    {
        return view("Admin.register");
    }

    public function ajout_acte()
    {
        if (Session::has('AdminId')) {
            # code...
            $adminId = Session::get('AdminId');
            $acte = Acte::all();
            return view('Admin.ajout-acte', compact('acte'));
        }
        return redirect('/');
    }

    public function ajout_depense()
    {
        if (Session::has('AdminId')) {
            # code...
            $typedepense = TypeDepense::all();
            return view('Admin.ajout-depense', compact('typedepense'));
        }
        return redirect('/');
    }

    public function ajout_patient()
    {
        if (Session::has('AdminId')) {
            # code...
            $genre = Genre::all();
            $patient = Patient::all();
            return view('Admin.ajout-patient', compact('genre', 'patient'));
        }
        return redirect('/');
    }

    public function profile()
    {
        if (Session::has('AdminId')) {
            # code...
            $adminId = Session::get('AdminId');
            $admin = Admin::find($adminId);
            return view('Admin.profile', compact('admin'));
        }
        return redirect('/');
    }
    ////////////////////////////////

    ///USER///
    ////////////////////////////////
    public function index_User()
    {
        if (Session::has('EmployeId')) {
            $patient = V_Patient::paginate(10);
            return view("User.index", compact('patient'));
        }
        return redirect('/User');
    }
    public function acte_patient(Request $request)
    {
        if (Session::has('EmployeId')) {
            $date = strtotime($request->input('date'));
            $time = date('Y-m-d H:i:s', $date);
            $patientid = $request->input('id');
            $patientActe = new PatientActe();
            $patientActe->patientid = $patientid;
            $patientActe->created_at = $time;
            $patientActe->save();
            // $insertPatientActe = PatientActe::create([
            //     'patientid' => $patientid,
            //     'created_at' => $time,
            // ]);
            $id = $patientActe->id;
            return redirect('/p-acte-patient?id=' . $id . '&patientid=' . $patientid);
        }
        return redirect('/User');
    }
    public function p_acte_patient(Request $request)
    {
        if (Session::has('EmployeId')) {
            $id = $request->input('id');
            $patientid = $request->input('patientid');
            $patient = V_Patient::find($patientid);
            $acte = Acte::all();
            $patientActe = PatientActe::find($id);
            $patientActeDetail = PatientActeDetail::where('patientacteid', '=', $id)->get();
            return view("User.acte-patient", compact('acte', 'patient', 'patientActe', 'patientActeDetail'));
        }
        return redirect('/User');
    }
    public function depense()
    {
        if (Session::has('EmployeId')) {
            $mois = Mois::all();
            $typedepense = TypeDepense::all();
            $currentDate = Carbon::now()->toDateString();
            $depense = Depense::all(); //whereDate('created_at', '=', $currentDate)->get();
            return view("User.depense", compact('depense', 'typedepense', 'mois'));
        }
        return redirect('/User');
    }
    public function liste_facture(Request $request)
    {
        if (Session::has('EmployeId')) {
            $patientid = $request->input('patientid');
            $patientActe = PatientActe::where('patientid', '=', $patientid)->get();
            return view("User.liste-facture", compact('patientActe'));
        }
        return redirect('/User');
    }
    ////////////////////////////////
}
