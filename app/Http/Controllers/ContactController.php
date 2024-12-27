<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\FormData;

class ContactController extends Controller
{
    public function index()
    {
        $contact = FormData::orderBy('id', 'desc')->paginate(10);
        // dd($contact);die;
        return view('admin.form_data', compact('contact')); // Ensure this matches your Blade view name
    }

    public function show()
    {
        $contact = Contact::orderBy('id', 'desc')->paginate(10);
        // dd($contact);die;
        return view('admin.contact', compact('contact')); // Ensure this matches your Blade view name
    }

    public function submit(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);


        // Get the user's IP address
        $ipAddress = $request->ip();


        $contact = new Contact();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->ip_address = $request->$ipAddress;
        // Save the property to the database to get the ID
        $contact->save();

        return redirect()->route('thank-you');        
        return redirect()->back()->with('success', 'Thank you for your message!');
    }
}
