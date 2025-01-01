<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FarmerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            try {

            // Validate incoming data
            $validator = Validator::make($request->all(), [
                'farmName' => 'required|string|max:255',
                'farmAddress' => 'required|string|max:255',
                'farmSize' => 'required|string|max:255',
                'typeOfFarming' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:15',
                'farmerLocation' => 'nullable|string|max:255', // Optional field for location
                'farmerName' => 'nullable|string|max:255', // Optional field for farmer's name
                'mobileMoneyNumber' => 'nullable|string|max:20',
                'bankAccountNumber' => 'nullable|string|max:20',
                'bankName' => 'nullable|string|max:255',
                'email' => 'required|email', // email is now required based on incoming data
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // Get the authenticated user (assuming you're using a token-based authentication)
            // $user = User::where('email', $request->email)->first(); // Assuming the user is authenticated via API tokens

            $usr = User::create([
                'fname' => $request->fName,
                'lname' => $request->lName,
                'email' => $request->email,
                'password' => Hash::make('F1Race'),
            ]);

            // Create a new farmer for the user
            $farmer = new Farmer([
                'user_id' => $usr->id, // Associate the farmer with the authenticated user
                'farm_name' => $request->farmName,
                'farm_address' => $request->farmAddress,
                'farm_size' => $request->farmSize,
                'type_of_farming' => $request->typeOfFarming,
                'phone' => $request->phoneNumber,
                'farmer_location' => $request->farmerLocation,
                'farmer_name' => $request->farmerName,
                'mobile_money_number' => $request->mobileMoneyNumber,
                'bank_account_number' => $request->bankAccountNumber,
                'bank_name' => $request->bankName,
                'is_prospect' => $request->isProspect,
            ]);
            $farmer->save();

            // Return response after creating or updating the farmer
            return response()->json(['message' => 'Farmer created or updated successfully!', 'farmer' => $farmer], 200);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
