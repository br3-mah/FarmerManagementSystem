<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PackageController extends Controller
{
    public function uploadModulePackage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'zipFile' => 'required|file|mimes:zip|max:20480', // Limit to 20MB
        ]);

        // Store the uploaded ZIP file temporarily
        $file = $request->file('zipFile');
        $filePath = $file->storeAs('modules/temp', $file->getClientOriginalName());

        $storagePath = storage_path('app/' . $filePath);

        // Extract the ZIP file
        $zip = new ZipArchive;
        if ($zip->open($storagePath) === true) {
            $extractPath = base_path('Modules/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $zip->extractTo($extractPath);
            $zip->close();

            // Delete the temporary ZIP file
            Storage::delete($filePath);

            return response()->json([
                'status' => 'success',
                'message' => 'Module uploaded and extracted successfully!',
            ]);
        } else {
            // Delete the temporary ZIP file if extraction fails
            Storage::delete($filePath);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to extract the ZIP file.',
            ], 500);
        }
    }
}

