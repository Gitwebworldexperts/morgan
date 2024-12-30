<?php

// app/Http/Controllers/CompanyController.php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string',
            'company_detail' => 'required|string',
            'track_record' => 'nullable|array',
        ]);

        $trackRecordData = [];
        foreach ($request->track_record['tr_id'] as $index => $tr_id) {
            $trackRecordData[] = [
                'tr_id' => $tr_id,
                'tr_name' => $request->track_record['tr_name'][$index] ?? '',
            ];
        }
    
        $data['track_record'] = json_encode(['data' => $trackRecordData]);

        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company added successfully!');
    }

    public function edit(Company $company)
    {
        return view('companies.form', compact('company'));
    }

    public function update(Request $request, Company $company)
{
    $data = $request->validate([
        'company_name' => 'required|string',
        'company_detail' => 'required|string',
        'track_record' => 'nullable|array',
    ]);

    // Convert track_record to the desired structure
    $trackRecordData = [];
    foreach ($request->track_record['tr_id'] as $index => $tr_id) {
        $trackRecordData[] = [
            'tr_id' => $tr_id,
            'tr_name' => $request->track_record['tr_name'][$index] ?? '',
        ];
    }

    $data['track_record'] = json_encode(['data' => $trackRecordData]);

    $company->update($data);

    return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
}


    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}
