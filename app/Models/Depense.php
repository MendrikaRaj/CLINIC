<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = ['typedepenseid', 'montant'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'typedepenseid' => 'required|integer',
            'montant' => 'required'
        ];

        $messages = [
            'typedepenseid.required' => 'S\'il vous plait remplissez ce champ',
            'montant.required' => 'S\'il vous plait remplissez ce champ',

        ];

        return compact('rules', 'messages');
    }
}
