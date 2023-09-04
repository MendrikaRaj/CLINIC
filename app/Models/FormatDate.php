<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatDate extends Model
{
    public static function getage($date)
    {
        return Carbon::parse($date)->age;
    }
    public static function formatFR($d)
    {
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        $date = Carbon::parse($d);
        return $date->locale('fr_FR')->isoFormat('LL');
    }
}
