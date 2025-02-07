<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportIndividual;
use App\Models\ReportForm;

class ReportFormController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            // 'last_name' => 'string|max:255',
            'email' => 'required',
            // 'newsletter' => 'sometimes|boolean',
            // 'mobile' => 'required|string|max:15',
            'report_id' => 'required'
        ]);

        $countryCode = $request->input('country_code') ?: ""; // Use null coalescing shorthand
        $mobile = $request->input('mobile');
        $fullNumber = $countryCode . $mobile;

        ReportForm::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'newsletter' => $request->has('newsletter'),
            'mobile' => $fullNumber,
            'report_id' => $request->input('report_id'),
        ]);

        $report = ReportIndividual::where('id',$request->input('report_id'))->first();
        
        return view('thanks')->with(['download_url'=>$report->thank_document]);
        
        // return back()->with('success', 'Your information has been saved!');
    }

    public function reportForm($id){
        $report_detail = ReportIndividual::where('id',$id)->first();
        $report_form_data = ReportForm::where('report_id',$id)->get();
        return view('reportindividual.reportForm', compact('report_form_data','report_detail'));
    }

}
