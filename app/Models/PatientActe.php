<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActe extends Model
{
    use HasFactory;
    protected $fillable = ['patientid'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'patientid' => 'required|integer',
        ];

        $messages = [
            'patientid.required' => 'S\'il vous plait remplissez ce champ',
        ];

        return compact('rules', 'messages');
    }
}
