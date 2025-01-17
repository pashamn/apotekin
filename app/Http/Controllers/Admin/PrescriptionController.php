<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    // Display a listing of prescriptions
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    // Display the specified prescription
    public function show(Prescription $prescription)
    {
        return view('admin.prescriptions.show', compact('prescription'));
    }

    // Approve a prescription
    public function approve(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->status = 'approved';
        $prescription->save();
    
        // Redirect to order creation page with prescription ID
        return redirect()->route('admin.orders.create', ['prescription_id' => $prescription->id]);
    }

    // Reject a prescription
    public function reject(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->status = 'rejected';
        $prescription->save();

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    // Add a new order associated with a prescription
    public function addOrder(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Membuat order baru
        $order = Order::create([
            'prescription_id' => $prescription->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => 'pending', // Status awal
        ]);

        // Merespon dengan sukses
        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }
}
