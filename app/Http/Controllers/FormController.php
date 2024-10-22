<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNumber' => 'required|string|max:20',
            'message' => 'required|string',
            // 'pageName' => 'required|string|max:255',
            // 'pageId' => 'required|string|max:255',
        ]);
        $previousUrl = url()->previous();

        FormData::create([
            'full_name' => $request->fullName,
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'message' => $request->message,
            'page_name' => $previousUrl ?? "",
            'page_id' => $request->pageId ?? "",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
