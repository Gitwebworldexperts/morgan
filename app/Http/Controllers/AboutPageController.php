<?php 
namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\AboutPageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageUploadService;

class AboutPageController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::with('sections')->first();
        return view('about.index', compact('aboutPage'));
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'team_description' => 'required|string',
            'main_background' => 'nullable|image',
        ]);

        $aboutPage = AboutPage::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'team_description' => $validated['team_description'],
            'main_background' => $request->hasFile('main_background') ? $imageUploadService->storeImage($request->file('main_background'), 'images'): null,
        ]);

        return redirect()->route('about.index');
    }

    public function update(Request $request, $aboutPage, ImageUploadService $imageUploadService)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'team_description' => 'required|string',
            'main_background' => 'nullable|image',
        ]);
        $aboutPage = AboutPage::findOrFail($aboutPage);
        $aboutPage->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'team_description' => $validated['team_description'],
            'main_background' => $request->hasFile('main_background') ? $imageUploadService->storeImage($request->file('main_background'), 'images') : $aboutPage->main_background,
        ]);

        return redirect()->route('about.index');
    }

    public function storeSection(Request $request, AboutPage $aboutPage,ImageUploadService $imageUploadService)
    {
        $validated = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $aboutPage->sections()->create([
            'heading' => $validated['heading'],
            'description' => $validated['description'],
            'image' => $request->hasFile('image') ? $imageUploadService->storeImage($request->file('image'), 'images'): null,
        ]);

        return redirect()->route('about.index');
    }

    public function destroySection(AboutPageSection $section)
    {
        $section->delete();
        return redirect()->route('about.index');
    }
}
