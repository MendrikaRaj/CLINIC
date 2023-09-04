<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_Patient extends Model
{
    use HasFactory;
    protected $table = 'v_patient';
    protected $fillable = ['nom', 'datenaissance', 'remboursement', 'genre'];
}
