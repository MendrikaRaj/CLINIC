<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'datenaissance', 'remboursement', 'genreid'];

    public static function getValidationRules($id = null)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $rules = [
            'nom' => 'required',
            'datenaissance' => [
                'required',
                'date',
                'before_or_equal:' . $currentDate,
            ],
            'remboursement' => 'required|integer',
            'genreid' => 'required|integer',
        ];

        $messages = [
            'nom.required' => 'S\'il vous plait remplissez ce champ',
            'datenaissance.required' => 'S\'il vous plait remplissez ce champ',
            'remboursement.required' => 'S\'il vous plait remplissez ce champ',
            'genreid.required' => 'S\'il vous plait remplissez ce champ',
        ];

        return compact('rules', 'messages');
    }
}
