<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth')->except('contactus','PrivacyPolicy','communitiesDetail');
    }
    public function settings()
    {
        return view('admin.settings');
    }
    public function contactus()
    {
        return view('contactus');
    }
    public function PrivacyPolicy($id)
    {
        $privacy_policy = PrivacyPolicy::where('slug',$id)->first();
        return view('privacy')->with('privacy_policy',$privacy_policy);
    }

    public function privacy(){
        return view('admin.pages.privacy');
    }

    public function PrivacyList(Request $request)
    {
        $list = PrivacyPolicy::all();
        return view('admin.pages.PrivacyList')->with('list', $list);
    }    

    public function PrivacyStore(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'slug' => 'required|string|unique:privacy_policies,slug|max:255',
            'page_content' => 'required|string',
        ]);
    
        $slug = Str::slug($request->input('slug'));

        // Create the privacy policy record with the modified slug
        PrivacyPolicy::create(array_merge($request->all(), ['slug' => $slug]));
    
        return redirect()->action([self::class, 'PrivacyList'])->with('success', 'Privacy Policy created successfully.');
    }    

    public function EditPrivacyPolicy($privacy_policy,Request $request){
        $data = PrivacyPolicy::find($privacy_policy);
        return view('admin.pages.editPrivacy')->with('privacy', $data);
    }

    public function UpdatePrivacyPolicy(Request $request,$id){
        $id = base64_decode($id);
        $post = PrivacyPolicy::find($id);
        $post->heading = $request->heading;
        $post->page_content = $request->page_content;
        $post->save();

        return redirect()->action([self::class, 'PrivacyList'])->with('success', 'Privacy Policy update successfully.');
    }
    public function PrivacyDestroy(Request $request,$id){
        $id = base64_decode($id);
        $post = PrivacyPolicy::find($id);
        if ($post) {
            $post->delete();
        }
        return redirect()->action([self::class, 'PrivacyList'])->with('success', 'Privacy Policy delete successfully.');
    }
    public function communitiesDetail(){
        return view('communities-detail');
    }
}
