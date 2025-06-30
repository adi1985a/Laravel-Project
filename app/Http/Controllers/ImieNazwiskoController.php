<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ImieNazwiskoController extends Controller
{
    public function wyswietlImieNazwisko()
    {
        $imie = "Adrian";
        $nazwisko = "Lesniak";
        $historia = Session::get('historia', []);

        return view('imie_nazwisko', compact('imie', 'nazwisko', 'historia'));
    }

    public function formularz()
    {
        return view('formularz');
    }

    public function zapiszDane(Request $request)
    {
        $request->validate([
            'imie' => 'required|min:2|max:50|alpha',
            'nazwisko' => 'required|min:2|max:50|alpha',
            'email' => 'required|email',
            'telefon' => 'nullable|regex:/^[0-9+\-\s()]+$/',
            'data_urodzenia' => 'nullable|date|before:today',
            'miasto' => 'nullable|string|max:100',
            'zawod' => 'nullable|string|max:100',
            'hobby' => 'nullable|string|max:200'
        ], [
            'imie.required' => 'First name is required',
            'imie.min' => 'First name must be at least 2 characters',
            'imie.alpha' => 'First name can only contain letters',
            'nazwisko.required' => 'Last name is required',
            'nazwisko.min' => 'Last name must be at least 2 characters',
            'nazwisko.alpha' => 'Last name can only contain letters',
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'telefon.regex' => 'Please provide a valid phone number',
            'data_urodzenia.before' => 'Birth date cannot be in the future'
        ]);

        $dane = [
            'imie' => ucfirst(strtolower($request->imie)),
            'nazwisko' => ucfirst(strtolower($request->nazwisko)),
            'email' => $request->email,
            'telefon' => $request->telefon,
            'data_urodzenia' => $request->data_urodzenia,
            'miasto' => $request->miasto,
            'zawod' => $request->zawod,
            'hobby' => $request->hobby,
            'data_wprowadzenia' => now()->format('Y-m-d H:i:s')
        ];

        $historia = Session::get('historia', []);
        array_unshift($historia, $dane);
        $historia = array_slice($historia, 0, 10);
        Session::put('historia', $historia);

        return redirect()->route('wyswietl-imie-nazwisko')
            ->with('success', 'Data has been saved successfully!');
    }

    public function profil()
    {
        $historia = Session::get('historia', []);
        $userIndex = request()->query('user', 0);
        $ostatniWpis = isset($historia[$userIndex]) ? $historia[$userIndex] : ( !empty($historia) ? $historia[0] : null );
        return view('profil', compact('ostatniWpis', 'historia'));
    }

    public function wyczyscHistorie()
    {
        Session::forget('historia');
        return redirect()->route('wyswietl-imie-nazwisko')
            ->with('success', 'Historia została wyczyszczona!');
    }

    public function statystyki()
    {
        $historia = Session::get('historia', []);
        $statystyki = [
            'liczba_wpisow' => count($historia),
            'najpopularniejsze_miasto' => $this->najpopularniejszeMiasto($historia),
            'najpopularniejszy_zawod' => $this->najpopularniejszyZawod($historia),
            'sredni_wiek' => $this->sredniWiek($historia),
            'ostatni_wpis' => !empty($historia) ? $historia[0]['data_wprowadzenia'] : null
        ];
        // Przygotowanie danych do wykresów
        $ageGroups = ['18-25'=>0, '26-35'=>0, '36-45'=>0, '46+'=>0];
        $timeline = [];
        foreach ($historia as $wpis) {
            if (!empty($wpis['data_urodzenia'])) {
                $age = now()->diffInYears($wpis['data_urodzenia']);
                if ($age >= 18 && $age <= 25) $ageGroups['18-25']++;
                elseif ($age >= 26 && $age <= 35) $ageGroups['26-35']++;
                elseif ($age >= 36 && $age <= 45) $ageGroups['36-45']++;
                elseif ($age >= 46) $ageGroups['46+']++;
            }
            $date = \Carbon\Carbon::parse($wpis['data_wprowadzenia'])->format('Y-m');
            if (!isset($timeline[$date])) $timeline[$date] = 0;
            $timeline[$date]++;
        }
        return view('statystyki', [
            'statystyki' => $statystyki,
            'historia' => $historia,
            'ageGroups' => $ageGroups,
            'timeline' => $timeline
        ]);
    }

    private function najpopularniejszeMiasto($historia)
    {
        if (empty($historia)) return 'Brak danych';
        
        $miasta = array_count_values(array_filter(array_column($historia, 'miasto')));
        return !empty($miasta) ? array_keys($miasta, max($miasta))[0] : 'Brak danych';
    }

    private function najpopularniejszyZawod($historia)
    {
        if (empty($historia)) return 'Brak danych';
        
        $zawody = array_count_values(array_filter(array_column($historia, 'zawod')));
        return !empty($zawody) ? array_keys($zawody, max($zawody))[0] : 'Brak danych';
    }

    private function sredniWiek($historia)
    {
        if (empty($historia)) return 0;
        
        $wiek = 0;
        $licznik = 0;
        
        foreach ($historia as $wpis) {
            if (!empty($wpis['data_urodzenia'])) {
                $wiek += now()->diffInYears($wpis['data_urodzenia']);
                $licznik++;
            }
        }
        
        return $licznik > 0 ? round($wiek / $licznik, 1) : 0;
    }
}

