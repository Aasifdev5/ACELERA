<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Mail\ComposeMail;

use App\Mail\SendMailreset;
use App\Models\BankDetails;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Campaign;

use App\Models\Category;
use App\Models\City;


use App\Models\Country;

use App\Models\GeneralSetting;


use App\Models\Like;



use App\Models\Notification;
use App\Models\Page;


use App\Models\PasswordReset;


use App\Models\Payment;

use App\Models\Role;

use App\Models\User;
use App\Notifications\NewUserRegisteredNotification;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserRegisteredNotification;
use App\Notifications\VerifyEmailNotification;
use App\Traits\SendNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


function getIp()
{
    $ip = null;
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    } else {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
    }
    return $ip;
}

class UserController extends Controller
{
    use SendNotification;
    public function sendMessageToFacebook()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer EAAM6vGg9kGoBO1cdP81yr1AEN5OQbRYG964jpoChcKefZAHHmn7C2xNXXepR314zwM7ovtdfhX3HVKVMC8V9TZCNglPTS6phykuZC0rFsIFSW0DoZAYy623mbfQCgxDZA6Kz80nHifq9zf74RkXZBWnLRbMxyt0gbuoiZA9VANsZB8dkaaPsQClpNvhrd622qJy0aNE7rPWTSkl3G7A3RWrne8pzwlFMxASPZC9YZD',
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v18.0/208828725650930/messages', [
            'messaging_product' => 'whatsapp',
            'to' => '918817016704',
            'type' => 'template',
            'template' => [
                'name' => 'hello_world',
                'language' => [
                    'code' => 'en_US'
                ]
            ]
        ]);

        return response()->json([
            'status_code' => $response->status(),
            'response_body' => $response->json(),
        ]);
    }


    public function index()
    {
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $categories = Category::all();
        $pages = Page::all();
        $project = Campaign::where('status', 1)->get();
        $freshProjects = Campaign::orderBy('id', 'desc')->take(10)->get();
        $blogs = Blog::all();
        $notificationCount = Notification::where('user_type', 2)
            ->where('is_seen', 'no')
            ->count();

        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($project as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }

        $general_setting = GeneralSetting::find('1');

        return view('index', compact(
            'categories',
            'user_session',
            'freshProjects',
            'pages',
            'general_setting',
            'project',
            'blogs',
            'notificationCount',
            'totalRaisedArray',
            'percentRaisedArray'
        ));
    }

    public function projects()
    {


        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = 'Projects';

        $campaigns = Campaign::where('status', 1)->get();
        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($campaigns as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }
        $pages = Page::all();
        return view('list', compact('campaigns', 'user_session', 'title', 'pages', 'totalRaisedArray', 'percentRaisedArray'));
    }
    public function project_category($category)
    {
        $campaigns = Campaign::join('categories', 'campaigns.category_id', '=', 'categories.id')
            ->where('categories.name', $category)
            ->where('campaigns.status', 1)
            ->select('campaigns.*')
            ->paginate(10);

        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = $category;
        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($campaigns as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }
        $pages = Page::all();
        return view('project_category', compact('campaigns', 'title', 'user_session', 'pages', 'totalRaisedArray', 'percentRaisedArray'));
    }
    public function Userlogin()
    {
        $pages = Page::all();
        return view('login', compact('pages'));
    }
    public function admin()
    {
        return view('admin.admin');
    }
    public function signup()
    {
        $pages = Page::all();
        return view('register', compact('pages'));
    }


    public function registration(Request $request)
    {
        $user = new User();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'account_type' => 'required',
            'mobile_number' => 'required'
        ]);
        $mobileNumber = $request->mobile_number;
        $prefixedMobileNumber = "591" . $mobileNumber;

        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'account_type' => $request->account_type,
            'mobile_number' => $prefixedMobileNumber,
            'ip_address' => getIp(),
        ]);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification($user));
        // Fire the UserRegistered event
        // event(new UserRegistered($user));
        $text = 'A new user has registered on the platform.';
        $target_url = route('users');
        $this->sendForApi($text, 1, $target_url, $user->id, $user->id);
        $pages = Page::all();
        if ($user) {
            return view('feedback', compact('user', 'pages'));
        } else {
            return back()->with('fail', 'failed');
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->password == $user->password) {
                if ($user->email_verified_at === null) {
                    return back()->with('fail', 'Your account is not verified. Please verify your email.');
                }

                $user->update(['is_online' => 1, 'last_seen' => Carbon::now()]);
                $request->session()->put('LoggedIn', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password does not match');
            }
        } else {
            return back()->with('fail', 'Email is not registered');
        }
    }
    public function ProjectDetail($slug)
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $campaign = Campaign::where('slug', $slug)->first();
        $projects = Campaign::inRandomOrder()->take(3)->get();
        $totalRaised = Payment::whereHas('campaign', function ($query) use ($campaign) {
            $query->where('id', $campaign->id);
        })
            ->where('accepted', 1)
            ->sum('amount');
        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($projects as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }
        $percentRaised = intval(($totalRaised / $campaign->goal) * 100);

        $general_setting = GeneralSetting::find('1');
        return view('appointment', compact('campaign', 'user_session', 'projects', 'percentRaised', 'general_setting', 'pages', 'totalRaisedArray', 'percentRaisedArray'));
    }
    public function MyProject()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $campaign = Campaign::where('user_id', Session::get('LoggedIn'))
                ->whereIn('status', [0, -1])
                ->get();


            $general_setting = GeneralSetting::find('1');
            return view('myprojects', compact('campaign', 'user_session',  'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    function userNotifications()
    {
        $notifications = Notification::where('user_type', 2)
            ->where('is_seen', 'no')
            ->orderByDesc('created_at')
            ->paginate(5);
        return response()->json($notifications);
    }
    public function MyPendingProject()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $campaign = Campaign::where('user_id', Session::get('LoggedIn'))->where('status', 0)->get();

            $general_setting = GeneralSetting::find('1');
            return view('mypendingproject', compact('campaign', 'user_session', 'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function MyActiveProject()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $campaign = Campaign::where('user_id', Session::get('LoggedIn'))->where('status', 1)->get();

            $general_setting = GeneralSetting::find('1');
            return view('myActiveproject', compact('campaign', 'user_session', 'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function edit_project(Request $request)
    {

        if (Session::has('LoggedIn')) {

            $project_detail = Campaign::where('id', $request->id)->first();
            $category = Category::all();
            $countries = Country::all();
            $pages = Page::all();
            $general_setting = GeneralSetting::find('1');
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            // dd($request->id);
            return view('edit_courses', compact('countries', 'user_session', 'project_detail', 'category', 'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function storeLikes(Request $request)
{



    // Create a new Like record
   $data= Like::create([
        'project_id' => $request->projectId,
    ]);
    // dd($data);
    // Get the updated like count for the project
    $likeCount = Like::where('project_id', $request->projectId)->count();

    // Return response (optional)
    return response()->json([
        'success' => true,
        'likeCount' => $likeCount,
        'message' => 'Liked Successfully'
    ]);
}

    public function checkLike(Request $request)
    {
        $projectId = $request->projectId; // Get the project ID
        $userId = Session::get('LoggedIn'); // Get the currently logged-in user ID

        // Check if user already liked the project
        $like = Like::where('project_id', $projectId)->exists();

        // Return response
        return response()->json([
            'liked' => $like,
        ]);
    }

    public function update_project(Request $request)
    {

        $user_id = Session::get('LoggedIn');

        $slug = unique_slug($request->title);

        // Retrieve the existing campaign by its ID
        $campaign = Campaign::findOrFail($request->id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image file if it exists
            if ($campaign->image) {
                // Construct the path to the previous image file
                $previousImagePath = public_path($campaign->image);

                // Check if the file exists before attempting to delete it
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath); // Delete the previous image file
                }
            }

            // Handle the new image upload
            $image = $request->file('image');
            $destination = 'Projects';
            $file_name = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/' . $destination), $file_name);
            $campaign->image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Update other fields with the new values from the request
        $campaign->user_id = $user_id;
        $campaign->category_id = $request->category;
        $campaign->title = $request->title;
        $campaign->slug = $slug;
        $campaign->description = $request->description;
        $campaign->campaign_owner_commission = get_option('campaign_owner_commission');
        $campaign->goal = $request->goal;
        $campaign->min_amount = $request->min_amount;
        $campaign->max_amount = $request->max_amount;

        $campaign->end_method = $request->end_method;
        $campaign->video = $request->video;
        $campaign->status = 0; // Assuming status is set to 0 for update
        $campaign->country_id = $request->country_id;
        $campaign->address = $request->address;
        $campaign->is_funded = 0; // Assuming is_funded is set to 0 for update
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;

        // Handle OG image updates (similar logic as image update)
        // Note: If og_image is also expected to be updated in this form, you should check if og_image file exists before deleting the previous one.
        if ($request->hasFile('og_image')) {
            // Delete the previous OG image file if it exists
            if ($campaign->og_image) {
                $previousOgImagePath = public_path($campaign->og_image);
                if (file_exists($previousOgImagePath)) {
                    unlink($previousOgImagePath); // Delete the previous OG image file
                }
            }

            // Handle the new OG image upload
            $og_image = $request->file('og_image');
            $destination = 'meta';
            $file_name = time() . '-' . Str::random(10) . '.' . $og_image->getClientOriginalExtension();
            $og_image->move(public_path('uploads/' . $destination), $file_name);
            $campaign->og_image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Save the updated campaign
        if ($campaign->save()) {
            // If the update is successful, return success message
            return redirect('MyProject')->with('success', 'Project updated successfully');
        }

        // If the update fails, return error message
        return back()->with('fail', 'Failed to update project');
    }
    public function Delete_project(Request $request)
    {
        $category = Campaign::find($request->id);
        $category->delete();

        return redirect('MyProject')->with('success', 'Deleted Succesuufully');
    }
    public function sendResetPasswordLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('fail', 'Email address not found.');
        }
        $token = Str::random(40);


        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $token = PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => $datetime
            ]
        );

        // Send the password reset notification
        $user->notify(new ResetPasswordNotification($token));

        return back()->with('success', 'Password reset link sent successfully.');
    }

    public function dashboard()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            $pages = Page::all();

            return view('dashboard', compact('user_session', 'pages'));
        }
    }
    public function news()
    {

        $news = Blog::orderBy('id', 'DESC')->paginate(3);

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $data['blogComments'] = BlogComment::active();
        $blogComments = $data['blogComments']->whereNull('parent_id')->get();
        $pages = Page::all();
        $latest_posts = Blog::orderBy('id', 'DESC')->paginate(3);
        $general_setting = GeneralSetting::find('1');
        return view('ads', compact('user_session', 'latest_posts', 'news', 'pages', 'blogComments', 'general_setting'));
    }
    public function news_category($slug)
    {
        $news = DB::table('blogs')
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blog_categories.slug', $slug)
            ->select('blogs.*')
            ->get();

        // dd($news);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = $slug;
        $data['blogComments'] = BlogComment::active();
        $blogComments = $data['blogComments']->whereNull('parent_id')->get();
        $pages = Page::all();
        $latest_posts = Blog::orderBy('id', 'DESC')->paginate(3);
        $general_setting = GeneralSetting::find('1');
        return view('news_category', compact('user_session', 'latest_posts', 'title', 'news', 'pages', 'blogComments', 'general_setting'));
    }
    public function blogCommentStore(Request $request)
    {
        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = $request->user_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->status = 1;

        if ($comment->save()) {
            // Retrieve updated comments for the specific blog
            $blogComments = BlogComment::active()
                ->where('blog_id', $request->blog_id)
                ->whereNull('parent_id')
                ->get();

            return response()->json([
                'success' => true,

            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function blogCommentReplyStore(Request $request)
    {
        if ($request->user_id && $request->comment) {
            $comment = new BlogComment();
            $comment->blog_id = $request->blog_id;
            $comment->user_id = $request->user_id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->comment = $request->comment;
            $comment->status = 1;
            $comment->parent_id = $request->parent_id;
            $comment->save();

            return response()->json([
                'success' => true,
                'message' => 'Comment successfully added.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store comment.',
            ]);
        }
    }

    public function searchBlogList(Request $request)
    {
        $data['blogs'] = Blog::active()->where('title', 'like', "%{$request->title}%")->get();


        return view('frontend.blog.render-search-blog-list', $data);
    }


    public function blog_details($id)
    {
        $blog_details = Blog::where('slug', $id)->first();

        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $data['blogComments'] = BlogComment::active();
        $blogComments = $data['blogComments']->where('blog_id', $blog_details->id)->whereNull('parent_id')->get();
        $pages = Page::all();
        $latest_posts = Blog::orderBy('id', 'DESC')->paginate(3);


        return view('ad_details', compact('blog_details', 'user_session', 'latest_posts', 'blogComments', 'pages'));
    }
    public function CreateProject()
    {
        $category = Category::all();
        $countries = Country::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $pages = Page::all();
        return view('post', compact('countries', 'category', 'pages', 'user_session'));
    }
    public function ProjectStore(Request $request)
    {

        $rules = [
            'category' => 'required',
            'title' => 'required',
            'image' => 'required',

            'description' => 'required',
            // 'short_description' => 'required|max:200',
            'goal' => 'required',
            'end_method' => 'required',
            'country_id' => 'required',
        ];

        $this->validate($request, $rules);

        $user_id = Session::get('LoggedIn');

        $slug = unique_slug($request->title);
        if ($request->hasFile('image')) {

            // Handle new image upload
            $attribute = $request->file('image');
            $destination = 'Projects';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $image = 'uploads/' . $destination . '/' . $file_name;
        }
        //feature image has been moved to update
        $data = [
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'campaign_owner_commission' => get_option('campaign_owner_commission'),
            'goal' => $request->goal,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,

            'end_method' => $request->end_method,
            'video' => $request->video,
            'feature_image' => '',
            'status' => 0,
            'country_id' => $request->country_id,
            'address' => $request->address,
            'is_funded' => 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $attribute = $request->file('og_image');
            $destination = 'meta';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update og_image path
            $data['og_image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        $create = Campaign::create($data);
        $text = 'A new project has posted on the platform.';
        $target_url = url('project-details', ['slug' => $slug]);
        $this->sendForApi($text, 1, $target_url, $user_id, $user_id);

        // dd($request->all());
        if ($create) {
            return back()->with('success', 'Project Created');
        }

        return back()->with('fail', 'Something went wrong');
    }

    public function back($id)
    {
        $campaign = campaign::where('id', $id)->first();
        $qrcode =  BankDetails::orderby('id', 'desc')->first();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $pages = Page::all();
        return view('back', compact('qrcode', 'campaign', 'pages', 'user_session'));
    }
    public function storeBack(Request $request)
    {

        // Store credit reload request
        $request->validate([
            'amount' => 'required|numeric',
            'payment_receipt' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $campaign_owner_user_id = Campaign::find($request->campaign_id)->user_id;
        $campaign_owner = User::find($campaign_owner_user_id);
        // dd($campaign_owner);
        $subject = "You have a new backer on your Campaign";
        $msg = str_ireplace("\r\n", "<br/>", "You have a new backer on your Campaign");

        // Assuming $name represents the name of the user
        $name = $campaign_owner->name;

        // Send email using the ComposeMail Mailable
        Mail::to($campaign_owner->email)->send(new ComposeMail($subject, $msg, $name));
        $text = "You have a new backer on your Campaign";
        $target_url = url('chat');

        $this->sendForApi($text, 2, $target_url, $campaign_owner_user_id, $request->user_id);
        $backer = User::find($request->user_id);
        $Payment = new Payment([
            'name' => $backer->name,
            'payer_email' => $backer->email,
            'user_id' => $request->user_id,
            'campaign_id' => $request->campaign_id,
            'amount' => $request->amount,
            'accepted' => false,
        ]);

        if ($request->hasFile('payment_receipt')) {
            $payment_receipt = $request->file('payment_receipt');
            $imageName = $payment_receipt->getClientOriginalName();
            $payment_receipt->move(public_path('payment_receipt'), $imageName);

            $Payment->payment_receipt = 'payment_receipt/' . $imageName;
        }


        $Payment->save();

        return redirect('dashboard')->with('success', 'Fund has request submitted');
    }

    public function WithdrawFunds()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('WithdrawFunds', compact('user_session'));
        }
    }

    public function change_password(Request $request)
    {

        $data = array();
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', '=', Session::get('LoggedIn'))->first();
        }
        $pages = Page::all();
        return view('change_password', compact('user_session', 'pages'));
    }
    public function update_password(Request $request)
    {


        $request->validate([
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        # Update the new Password
        $data = User::find($request->user_id);
        $data->password = ($request->new_password);
        $data->save();

        return back()->with('success', 'Successfully Updated');
    }



    public function logout(Request $request)
    {
        if (Session::has('LoggedIn')) {
            $data = User::find(Session::has('LoggedIn'));
            $data->update(['is_online' => 0, 'last_seen' => Carbon::now()]);
            Session::forget('LoggedIn');
            $request->session()->invalidate();
            return redirect('/');
        }
    }

    public function edit_profile()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $pages = Page::all();
            return view('edit_profile', compact('user_session', 'pages'));
        }
    }
    public function update_profile(Request $request)
    {

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if a new profile photo is provided
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $imageName = $profilePhoto->getClientOriginalName();

            // Move the uploaded file to the 'profile_photo' directory in the public path
            $profilePhoto->move(public_path('profile_photo'), $imageName);

            // Update the profile photo variable
            $profile = $imageName;
        } else {
            // If no new photo is provided, use the existing one
            $user = User::find($request->user_id);
            $profile = $user->profile_photo;
        }
        $mobileNumber = $request->mobile_number;
        $prefixedMobileNumber = "591" . $mobileNumber;

        // Update user data in the database
        $userUpdate = User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'mobile_number' => $prefixedMobileNumber,
            'email' => $request->email,
            'profile_photo' => $profile,
        ]);

        if ($userUpdate) {
            return redirect('dashboard')->with('success', 'Profile Updated Successfully');
        } else {
            return back()->with('fail', 'Failed to update profile');
        }
    }

    public function forget_password()
    {
        $pages = Page::all();
        return view('forget_password', compact('pages'));
    }
    public function forget_mail(Request $request)
    {
        try {
            $customer = User::where('email', $request->email)->get();

            if (count($customer) > 0) {

                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/ResetPasswordLoad?token=' . $token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Please click on below link to reset your password.";
                $data['auth'] = "SkyForecastingTeam";

                Mail::to($request->email)->send(
                    new SendMailreset(
                        $token,
                        $request->email,
                        $data
                    )
                );


                $datetime = Carbon::now()->format('Y-m-d H:i:s');

                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return redirect('forget_password')->with('success', 'Please check your mail to reset your password');
                // return response()->json(['success' => true, 'msg' => 'Please check your mail to reset your password.']);
            } else {
                return redirect('forget_password')->with('fail', 'User not found');
                // return response()->json(['fail' => false, 'msg' => 'User not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    public function ResetPasswordLoad(Request $request)
    {

        $resetData =  PasswordReset::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {
            $customer = User::where('email', $resetData[0]['email'])->get();
            $pages = Page::all();
            return view('ResetPasswordLoad', ['customer' => $customer], compact('pages'));
        }
    }



    public function ResetPassword(Request $request)
    {

        $request->validate([

            'email' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:30'],
        ]);

        $data = User::where('email', $request->email)->first();

        $data->password = $request->password;
        $data->custom_password = $request->password;
        $data->update();

        PasswordReset::where('email', $data->email)->delete();

        echo "<h1>Successfully Reset Password</h1>";
        return redirect('Userlogin');
    }
}
