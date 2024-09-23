<?php
namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $faqs = Faqs::orderBy('id', 'desc')->get();
        // $faqs = Faqs::all();
        return view('admin.faq.faq', compact('faqs'));
     }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'question' => 'required|array',
            'answer' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            foreach ($request->question as $key => $value) {
                if (isset($request->answer[$key])) {
                   $save = Faqs::create([
                        'question' => $value,
                        'answer' => $request->answer[$key],
                        'page' => $request->linked_page[$key] ?? "",
                    ]);
                }
            }

            return redirect()->route('faq.index')->with('success', 'FAQs stored successfully!');
        } catch (\Exception $e) {
            // Log the exception if necessary
            \Log::error($e);
            return redirect()->back()->with('error', 'There was an error saving your FAQs. Please try again.')->withInput();
        }
    }


    public function edit(Faqs $faq)
    {   
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faqs $faq)
    {
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->page = $request->linked_page ?? "";
        $faq->save();
        return redirect()->route('faq.index')->with('success', 'FAQs update successfully!');
    }

    public function destroy(Faqs $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index')->with('success', 'FAQs delete successfully!');
    }
}
