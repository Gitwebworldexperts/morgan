<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'detail' => 'required|string',
            'name' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|boolean',
        ]);

        Testimonial::create($validated);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials.show', compact('testimonial'));
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'detail' => 'required|string',
            'name' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|boolean',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($validated);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
