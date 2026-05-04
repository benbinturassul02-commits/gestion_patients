<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Patient;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->input('date');

        $rendezvous = Rendezvous::with('patient')
            ->when($date, function ($query, $date) {
                return $query->whereDate('date', $date);
            })
            ->latest()
            ->paginate(10);

        return view('rendezvous.index', compact('rendezvous', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();

        return view('rendezvous.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'heure' => 'required',
            'description' => 'nullable',
        ]);

        Rendezvous::create($request->only([
            'patient_id',
            'date',
            'heure',
            'description'
        ]));

        return redirect()->route('rendezvous.index')
                         ->with('success', 'Rendez-vous ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rendezvous $rendezvous)
    {
        $patients = Patient::all();

        return view('rendezvous.edit', compact('rendezvous', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rendezvous $rendezvous)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'heure' => 'required',
            'description' => 'nullable',
        ]);

        $rendezvous->update($request->only([
            'patient_id',
            'date',
            'heure',
            'description'
        ]));

        return redirect()->route('rendezvous.index')
                         ->with('success', 'Rendez-vous modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rendezvous $rendezvous)
    {
        $rendezvous->delete();

        return redirect()->route('rendezvous.index')
                         ->with('success', 'Rendez-vous supprimé avec succès');
    }
}