<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDepense extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'budgetannuel', 'code'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'nom' => $id ? 'sometimes' : 'required|unique:type_depenses',
            'budgetannuel' => 'required',
            'code' => 'required'
        ];

        $messages = [
            'nom.required' => 'S\'il vous plait remplissez ce champ',
            'budgetannuel.required' => 'S\'il vous plait remplissez ce champ',
            'code.required' => 'S\'il vous plait remplissez ce champ',

        ];

        return compact('rules', 'messages');
    }
}
