<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'tarif', 'photo'];

    public static function getValidationRules($id = null)
    {
        $rules = [
            'nom' => 'required',
            'tarif' => 'required',
            'photo' => $id ? 'sometimes|image|mimes:jpeg,png,jpg|max:5048' : 'required|image|mimes:jpeg,png,jpg|max:5048'
        ];

        $messages = [
            'nom.required' => 'S\'il vous plait remplissez ce champ',
            'tarif.required' => 'S\'il vous plait remplissez ce champ',
            'photo.required' => 'S\'il vous plait remplissez ce champ',
            'photo.image' => 'Le champ photo doit être une image',
            'photo.mimes' => 'Le champ photo doit être au format :jpeg, .png ou .jpg',
            'photo.max' => 'La taille maximale de la photo est de 5048 KB'
        ];

        return compact('rules', 'messages');
    }
}
