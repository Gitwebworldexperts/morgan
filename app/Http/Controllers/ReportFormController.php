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
        
        return view('reportThanks')->with(['download_url'=>$report->thank_document,'report' => $report]);
        
        // return back()->with('success', 'Your information has been saved!');
    }

    public function reportForm($id){
        $report_detail = ReportIndividual::where('id',$id)->first();
        $report_form_data = ReportForm::where('report_id',$id)->get();
        return view('reportindividual.reportForm', compact('report_form_data','report_detail'));
    }

    public function exportReportToCSV($id)
    {
        $report_detail = ReportIndividual::where('id',$id)->first();
        if(!$report_detail){
            return response()->json([
                'status' => 'error',
                'message' => 'Individual Report not found to export.'
            ], 404);               
        }
        $report_form_data = ReportForm::where('report_id',$id)->get();
        if($report_form_data->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'No records found to export.'
            ], 404);               
        }
        $fileName = 'Report_Form_Data.csv';
        
    
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    
        // Your column headers
        $columns = ['S.NO', 'First Name', 'Last Name', 'Email', 'Mobile' ,'Newseletter', 'Created At'];
    
        $callback = function() use($report_form_data, $columns) {
            $file = fopen('php://output', 'w');
    
            // 🔥 Title Row
            fputcsv($file, ['User Export Report - Generated on ' . now()->format('Y-m-d H:i:s')]);
            
            // ✅ Empty row for spacing (optional)
            fputcsv($file, []);
            
            // 🧩 Column headers
            fputcsv($file, $columns);
    
            // 🔁 Data rows
            $count = 0; 
            foreach ($report_form_data as $user) {
                $count = $count + 1;
                fputcsv($file, [
                    $count,
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    $user->mobile,
                    $user->newsletter,
                    $user->created_at,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    
}
