<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'email', 'password'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'nom' => 'required',
            'email' => $id ? 'sometimes|email' : 'required|email|unique:employes',
            'password' => 'required'
        ];

        $messages = [
            'nom.required' => 'S\'il vous plait remplissez ce champ',
            'email.required' => 'S\'il vous plait remplissez ce champ',
            'password.required' => 'S\'il vous plait remplissez ce champ',

        ];

        return compact('rules', 'messages');
    }
}
