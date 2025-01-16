<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    // Display a listing of prescriptions
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    // Show the form for creating a new prescription
    public function create()
    {
        return view('admin.prescriptions.create');
    }

    // Store a newly created prescription in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'image' => 'nullable|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        Prescription::create($validated);

        return redirect()->route('admin.prescriptions.index')->with('success', 'Prescription created successfully!');
    }

    // Display the specified prescription
    public function show(Prescription $prescription)
    {
        return view('admin.prescriptions.show', compact('prescription'));
    }

    // Show the form for editing the specified prescription
    public function edit(Prescription $prescription)
    {
        return view('admin.prescriptions.edit', compact('prescription'));
    }

    // Update the specified prescription in storage
    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'image' => 'nullable|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $prescription->update($validated);

        return redirect()->route('admin.prescriptions.index')->with('success', 'Prescription updated successfully!');
    }

    // Remove the specified prescription from storage
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('admin.prescriptions.index')->with('success', 'Prescription deleted successfully!');
    }
}