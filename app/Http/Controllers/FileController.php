<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // Create & Upload File
    public function create(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240', // Validate the file type and size
        ]);

        // Store the file in public storage
        $path = $request->file('file')->store('uploads', 'public');

        // Create a new file record in the database
        $file = File::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
        ]);

        // Return the file URL
        return response()->json([
            'message' => 'File uploaded successfully!',
            'file_url' => Storage::url($file->file_path),
        ]);
    }

    // Read (List Files)
    public function index()
    {
        $files = File::all();
        return response()->json($files);
    }

    // Update File (Upload New File)
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240',
        ]);

        // Find the existing file record
        $file = File::findOrFail($id);

        // Delete the old file from storage
        Storage::disk('public')->delete($file->file_path);

        // Store the new file
        $path = $request->file('file')->store('uploads', 'public');

        // Update the file record
        $file->name = $request->file('file')->getClientOriginalName();
        $file->file_path = $path;
        $file->save();

        return response()->json([
            'message' => 'File updated successfully!',
            'file_url' => Storage::url($file->file_path),
        ]);
    }

    // Delete File
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($file->file_path);

        // Delete the file record from database
        $file->delete();

        return response()->json([
            'message' => 'File deleted successfully!',
        ]);
    }
}
