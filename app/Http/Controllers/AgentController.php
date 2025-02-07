<?php
namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::orderBy('created_at', 'desc')->get();
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'username' => 'required|email|unique:agents',
            'email' => 'required|email|unique:agents',
            'mobile' => 'nullable|numeric|digits_between:1,15',
            'phone' => 'nullable|numeric|digits_between:1,15',
            'photo' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ]);

        $agent = new Agent($request->except('photo'));
        
        if ($request->hasFile('photo')) {
            $agent->photo = $imageUploadService->storeImage($request->file('photo'), 'images');
        }

        $agent->save();

        return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
    }

    public function edit(Agent $agent)
    {
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'username' => 'required|email|unique:agents,username,' . $agent->id,
            'email' => 'required|email|unique:agents,email,' . $agent->id,
            'mobile' => 'nullable|numeric|digits_between:1,15',
            'phone' => 'nullable|numeric|digits_between:1,15',
            'photo' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ]);

        $agent->fill($request->except('photo'));

        if ($request->hasFile('photo')) {
            $agent->photo = $imageUploadService->storeImage($request->file('photo'), 'images');
        }

        $agent->save();

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
