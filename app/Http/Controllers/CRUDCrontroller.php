<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CRUDCrontroller extends Controller
{
    //Fonction pour insérer un objet dans la base
    public function inserer(Request $request, $modelName)
    {
        $name = 'App\Models\\' . $modelName;
        $data = $request->all();
        $validationData = $name::getValidationRules();
        $rules = $validationData['rules'];
        $messages = $validationData['messages'];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->storeAs('public/uploads', $file->getClientOriginalName());
            $data['photo'] = $path;
        }
        $model = new $name($data);
        $res = $model->save();
        $message = $res ? $modelName . ' enregistré avec succès' : 'Enregistrement de ' . $modelName . ' échoué';
        $status = $res ? 'success' : 'error';
        return back()->with($status, $message);
    }


    //Fonction pour mettre à jour les données des tables dans la base
    public function modifier(Request $request, $modelName, $id)
    {
        $name = 'App\Models\\' . $modelName;
        $data = $request->except('id');
        $validationData = $name::getValidationRules($id);
        $rules = $validationData['rules'];
        $messages = $validationData['messages'];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->storeAs('public/uploads', $file->getClientOriginalName());
            $data['photo'] = $path;
        }
        $model = $name::find($id);
        if (!$model) {
            return back()->with('error', $modelName . ' non trouvé');
        }
        $model->fill($data);
        $res = $model->save();
        $message = $res ? $modelName . ' mise à jour avec succès' : 'Mise à jour de ' . $modelName . ' échouée';
        $status = $res ? 'success' : 'error';
        return back()->with($status, $message);
    }

    //Fonction pour supprimer des données dans la base
    public function supprimer($modelName, $id)
    {
        $name = 'App\Models\\' . $modelName;
        $model = $name::find($id);
        if (!$model) {
            return back()->with('error', $modelName . ' non trouvé');
        }
        $res = $model->delete();
        $message = $res ? $modelName . ' supprimer avec succès' : 'Suppression de ' . $modelName . ' échouée';
        $status = $res ? 'success' : 'error';
        return back()->with($status, $message);
    }

    public function ajout_depense_multiple(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'typedepenseid' => 'required|integer',
            'jour' => 'required|integer',
            'annee' => 'required|integer',
            'mois' => 'required|array',
            'montant' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $typedepenseid = $request->input('typedepenseid');
        $montant = $request->input('montant');
        $jour = $request->input('jour');
        $annee = $request->input('annee');
        $mois = $request->input('mois');
        $selectedMois = [];

        for ($i = 0; $i < count($mois); $i++) {
            if (
                ($mois[$i] == 2 && $jour > 28) ||
                ($mois[$i] == 4 && $jour > 30) ||
                ($mois[$i] == 6 && $jour > 30) ||
                ($mois[$i] == 9 && $jour > 30) ||
                ($mois[$i] == 11 && $jour > 30)
            ) {
                $selectedMois[] = $jour . "/" . $mois[$i] . "/" . $annee;
            }
        }

        if (!empty($selectedMois)) {
            $errorMessage = 'The following months have exceeded the maximum number of days: ' . implode(', ', $selectedMois);
            return back()->withErrors($errorMessage)->withInput();
        } else {
            foreach ($mois as $selectedMonth) {
                $created_at = Carbon::create($annee, $selectedMonth, $jour);
                $depense = new Depense();
                $depense->typedepenseid = $typedepenseid;
                $depense->montant = $montant;
                $depense->created_at = $created_at;
                $depense->updated_at = $created_at;
                $depense->save();
            }
            return back()->with('success', 'Dépense enregistrée avec succès');
        }
    }
}
