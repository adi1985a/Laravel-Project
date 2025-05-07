<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImieNazwiskoController extends Controller
{
    public function wyswietlImieNazwisko()
    {
        $imie = "Adrian";
        $nazwisko = "Lesniak";

        return view('imie_nazwisko', compact('imie', 'nazwisko'));
    }
}

