<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class DashboardController extends Controller
{

    public function index()
    {
        $prospects = Farmer::with('user')->where('is_prospect', 1)->get(); // Get all prospects
        $farmers = Farmer::with('user')->whereNot('is_prospect', 1)->get(); // Get all farmers
        $all_farmers = Farmer::with('user')->get(); // Get all farmers
        $latestFarmers = Farmer::latest()->take(10)->get(); // Get latest 10 farmers

        // Module counts
        $allModules = Module::all();

        $moduleCounts = [
            'available' => count($allModules),
        ];

        return view('dashboard', [
            'prospects' => $prospects,
            'farmers' => $farmers,
            'all_farmers' => $all_farmers,
            'latestFarmers' => $latestFarmers,
            'moduleCounts' => $moduleCounts, // Pass module counts to the view
        ])->layout('layouts.app');
    }

    public function statsJson()
    {
        // Retrieve data
        $prospects = Farmer::with('user')->where('is_prospect', 1)->get(); // Get all prospects
        $farmers = Farmer::with('user')->where('is_prospect', 0)->get(); // Get all farmers
        $users = User::get(); // Get all farmers

        // Return data as JSON response
        return response()->json([
            'total_users' => $users->count() - 1,
            'total_farmers' => $farmers->count(),
            'total_prospects' => $prospects->count(),
        ]);
    }

    public function recentJson()
    {
        $farmers = Farmer::with('user')->get();

        // Flatten and merge Farmer and User data into a single array
        $flattenedFarmers = $farmers->map(function ($farmer) {
            return array_merge(
                $farmer->toArray(),
                $farmer->user ? $farmer->user->toArray() : []
            );
        });

        // Return the flattened data as JSON response
        return response()->json([
            'farmers' => $flattenedFarmers,
        ]);
    }


}
