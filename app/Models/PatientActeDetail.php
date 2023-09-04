<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['patientacteid', 'acteid', 'montant'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'patientacteid' => 'required|integer',
            'acteid' => 'required|integer',
            'montant' => 'required',
        ];

        $messages = [
            'patientacteid.required' => 'S\'il vous plait remplissez ce champ',
            'acteid.required' => 'S\'il vous plait remplissez ce champ',
            'montant.required' => 'S\'il vous plait remplissez ce champ',
        ];

        return compact('rules', 'messages');
    }
}
