<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Str;
use App\Models\AboutPage;
use App\Models\PropertyManagement;
use App\Models\Post;
use App\Models\Career;
use App\Models\CareerPage;
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
        $this->middleware('auth')->except('contactus','BlogList','BlogSingle','PrivacyPolicy','communitiesDetail','PropertyManagement','CareerList','AboutUs');
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

    public function AboutUs(){
        $aboutPage = AboutPage::with('sections')->first();
        return view('about-us')->with('aboutPage',$aboutPage);
    }

    public function BlogList(){
        $posts = Post::with('tags')
                ->whereHas('tags', function ($query) {
                    $query->where('name', '!=', 'Region');
                })
                ->orWhereDoesntHave('tags')  // Include posts with no tags
                ->paginate(13);


        return view('blog-list')->with('posts',$posts);
    }


    public function BlogSingle($slug)
    {
        $post = Post::with('tags')->where('slug',$slug)->first();
        if($post){
            $relatedPostIdsArray = $post->related_posts ? explode(',', $post->related_posts) : [];
            $relatedPost = Post::select('name', 'images', 'slug', 'created_at')
            ->whereIn('id', $relatedPostIdsArray)
            ->get();
            return view('blog-detail')->with(['relatedPost' =>$relatedPost, 'post'=>$post]);       
        }
        return redirect()->action([self::class, 'BlogList'])->with('error', 'Page Not Found.');
    }


    public function PropertyManagement(){
        $data = PropertyManagement::latest()->first();
        $posts = Post::with('tags')
        ->whereHas('tags', function ($query) {
            $query->where('name', '!=', 'Region');
        })
        ->orWhereDoesntHave('tags')  // Include posts with no tags
        ->take(4)  // Limit the result to 4 posts
        ->get();  // Get the results
    

        return view('property_management')->with(['data' =>$data,"posts" => $posts]);        
    }
    public function CareerList(){
        $careerPage = CareerPage::with('images')->first();
        $careers = Career::all();
        return view('career_list')->with(['career' =>$careers,'careerPage'=>$careerPage]);
    }
    public function Careers($id){
        if($id){
            $id = base64_decode($id);
            $career = Career::find($id);
            if($career){
                return view('career')->with(['career' =>$career]);    
            }else{
                return redirect()->route('home');
            }
            
        }else{
            return redirect()->route('home');
        }   
    }
}
