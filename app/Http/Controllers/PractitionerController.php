<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\County; // <-- ADDED THIS IMPORT
use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    /**
     * Display a listing of all practitioners.
     */
    public function index()
    {
        // Fetches ALL records from the database, newest first
        $practitioners = Practitioner::latest()->get();
        
        return view('practitioners.index', compact('practitioners'));
    }

    /**
     * Show the form for creating a new practitioner.
     */
    public function create()
    {
        // ADDED: Fetch counties for the searchable dropdown
        $counties = County::orderBy('name')->pluck('name', 'name');
        
        return view('practitioners.create', compact('counties'));
    }

    /**
     * Store a newly created practitioner in storage.
     */
    public function store(Request $request)
    {
        // Validate the exact 7 fields from your form
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'activity'          => 'required|string|max:255',
            'county'            => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'required|email|max:255|unique:practitioners,email',
            'registration_date' => 'required|date',
            'renewal_date'      => 'required|date|after:registration_date',
        ], [
            'renewal_date.after' => 'The renewal date must be after the registration date.',
            'email.unique'       => 'This email is already registered.',
        ]);

        // Set default status and save
        $validated['status'] = 'Active';
        Practitioner::create($validated);

        // Redirect to the list page with a success message
        return redirect()->route('practitioners.index')
                         ->with('success', 'Practitioner registered successfully.');
    }

    /**
     * Display the specified practitioner.
     */
    public function show(Practitioner $practitioner)
    {
        return view('practitioners.show', compact('practitioner'));
    }

    /**
     * Show the form for editing the specified practitioner.
     */
    public function edit(Practitioner $practitioner)
    {
        // ADDED: Fetch counties for the searchable dropdown (in case your edit page uses it later)
        $counties = County::orderBy('name')->pluck('name', 'name');
        
        return view('practitioners.edit', compact('practitioner', 'counties'));
    }

    /**
     * Update the specified practitioner in storage.
     */
    public function update(Request $request, Practitioner $practitioner)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'activity'          => 'required|string|max:255',
            'county'            => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'required|email|max:255|unique:practitioners,email,' . $practitioner->id,
            'registration_date' => 'required|date',
            'renewal_date'      => 'required|date|after:registration_date',
        ]);

        $practitioner->update($validated);

        return redirect()->route('practitioners.index')
                         ->with('success', 'Practitioner updated successfully.');
    }

    /**
     * Remove the specified practitioner from storage.
     */
    public function destroy(Practitioner $practitioner)
    {
        $practitioner->delete();

        return redirect()->route('practitioners.index')
                         ->with('success', 'Practitioner deleted successfully.');
    }
}