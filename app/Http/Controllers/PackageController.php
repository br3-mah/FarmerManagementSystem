<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class PackageController extends Controller
{
//     public function uploadModulePackage(Request $request)
//     {
//         try {
//             // Validate the uploaded file
//             $request->validate([
//                 'moduleFile' => 'required|file|mimes:zip,rar|max:20480', // Limit to 20MB
//             ]);

//             // Store the uploaded file temporarily
//             $file = $request->file('moduleFile');
//             $filePath = $file->storeAs('modules/temp', $file->getClientOriginalName());
//             $storagePath = storage_path('app/' . $filePath);
//             $extractPath = base_path('Modules/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

//             // Create directory if it doesn't exist
//             if (!file_exists($extractPath)) {
//                 mkdir($extractPath, 0755, true);
//             }

//             $extension = strtolower($file->getClientOriginalExtension());

//             if ($extension === 'zip') {
//                 // Handle ZIP files
//                 $zip = new ZipArchive;
//                 if ($zip->open($storagePath) === true) {
//                     $zip->extractTo($extractPath);
//                     $zip->close();
//                 } else {
//                     throw new \Exception('Failed to open ZIP file: ' . $zip->getStatusString());
//                 }
//             } elseif ($extension === 'rar') {
//                 // Handle RAR files using unrar
//                 $command = "unrar x -o+ " . escapeshellarg($storagePath) . " " . escapeshellarg($extractPath);
//                 exec($command, $output, $returnVar);

//                 if ($returnVar !== 0) {
//                     throw new \Exception('Failed to extract RAR file. Command output: ' . implode("\n", $output));
//                 }
//             } else {
//                 throw new \Exception('Unsupported file extension: ' . $extension);
//             }

//             // Delete the temporary file
//             Storage::delete($filePath);

//             return response()->json([
//                 'status' => 'success',
//                 'message' => 'Module uploaded and extracted successfully!',
//             ]);
//         } catch (\Throwable $th) {
//             dd($th);

//             // Delete the temporary file if extraction fails
//             if (isset($filePath)) {
//                 Storage::delete($filePath);
//             }

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Failed to extract the file. Error: ' . $th->getMessage(),
//             ], 500);
//         }
//     }


// }


    public function uploadModulePackage(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'moduleFile' => 'required|file|mimes:zip,rar|max:20480', // Limit to 20MB
            ]);

            $file = $request->file('moduleFile');
            $filePath = $file->storeAs('modules/temp', $file->getClientOriginalName());
            $storagePath = storage_path('app/' . $filePath);
            $moduleName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extractPath = base_path('Modules/');
            $check = base_path('Modules/'.$moduleName);

            // Validate module name
            if (!preg_match('/^[a-zA-Z0-9_-]+$/', $moduleName)) {
                throw new \Exception('Invalid module name. Use only letters, numbers, underscores, and hyphens.');
            }

            // Check if module already exists
            if (file_exists($check)) {
                throw new \Exception('A module with this name already exists.');
            }

            // Create directory with proper permissions
            if (!mkdir($check, 0755, true)) {
                throw new \Exception('Failed to create module directory.');
            }

            $extension = strtolower($file->getClientOriginalExtension());

            if ($extension === 'zip') {
                $this->extractZip($storagePath, $extractPath);
            } elseif ($extension === 'rar') {
                $this->extractRar($storagePath, $extractPath);
            }

            // Delete the temporary file
            Storage::delete($filePath);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Module uploaded and extracted successfully!',
                'module' => $moduleName
            ]);

        } catch (\Throwable $th) {
            // Clean up on failure
            if (isset($filePath)) {
                Storage::delete($filePath);
            }
            if (isset($extractPath) && file_exists($extractPath)) {
                $this->cleanupModule($extractPath);
            }

            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to process module: ' . $th->getMessage()
            ], 500);
        }
    }

    private function extractZip(string $source, string $destination): void
    {
        $zip = new ZipArchive;
        $result = $zip->open($source);

        if ($result !== true) {
            throw new \Exception('Failed to open ZIP file: ' . $this->getZipErrorMessage($result));
        }

        try {
            if (!$zip->extractTo($destination)) {
                throw new \Exception('Failed to extract ZIP contents');
            }
        } finally {
            $zip->close();
        }
    }

    private function extractRar(string $source, string $destination): void
    {
        // Check if unrar is installed
        if (!$this->isUnrarAvailable()) {
            throw new \Exception('RAR extraction requires unrar to be installed on the server.');
        }

        $command = sprintf(
            'unrar x -o+ %s %s 2>&1',
            escapeshellarg($source),
            escapeshellarg($destination)
        );

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception('RAR extraction failed: ' . implode("\n", $output));
        }
    }

    private function isUnrarAvailable(): bool
    {
        exec('which unrar', $output, $returnVar);
        return $returnVar === 0;
    }

    private function isValidModuleStructure(string $path): bool
    {
        // Check for required module files/directories
        $requiredItems = [
            'composer.json',
            'module.json',
            'Providers',
            'Http/Controllers'
        ];

        foreach ($requiredItems as $item) {
            if (!file_exists($path . '/' . $item)) {
                return false;
            }
        }

        return true;
    }

    private function cleanupModule(string $path): void
    {
        if (file_exists($path)) {
            $command = sprintf('rm -rf %s', escapeshellarg($path));
            exec($command);
        }
    }

    private function getZipErrorMessage(int $code): string
    {
        $errors = [
            ZipArchive::ER_EXISTS => 'File already exists',
            ZipArchive::ER_INCONS => 'Zip archive inconsistent',
            ZipArchive::ER_MEMORY => 'Memory allocation failure',
            ZipArchive::ER_NOENT => 'No such file',
            ZipArchive::ER_NOZIP => 'Not a zip archive',
            ZipArchive::ER_OPEN => 'Can\'t open file',
            ZipArchive::ER_READ => 'Read error',
            ZipArchive::ER_SEEK => 'Seek error'
        ];

        return $errors[$code] ?? 'Unknown error';
    }
}
