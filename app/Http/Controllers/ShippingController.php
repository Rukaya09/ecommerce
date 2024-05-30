<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function create()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user already has a shipping address
        $existingShipment = Shipment::where('user_id', $user->id)->first();

        if ($existingShipment) {
            // Update the existing address
            $existingShipment->update($validatedData);
            $shipment = $existingShipment;
        } else {
            // Set the user_id field to the ID of the currently authenticated user
            $validatedData['user_id'] = $user->id;

            // Create a new shipment instance
            $shipment = Shipment::create($validatedData);
        }

        // Return the shipping record as JSON response
        return response()->json($shipment);
    }

    public function index()
    {
        // Fetch all shipments with related user information
        $shipments = Shipment::with('user')->get();

        // Return the shipments to the view
        return view('admin.shipping', compact('shipments'));
    }
}