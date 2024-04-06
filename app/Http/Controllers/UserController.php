<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Mail\SendMailreset;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\City;

use App\Models\Country;
use App\Models\GeneralSetting;


use App\Models\Page;

use App\Models\PasswordReset;


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
        $project = Campaign::all();
        $freshproject = Campaign::Orderby('id', 'desc')->take(10)->get();
        $blogs = Blog::all();


        $general_setting = GeneralSetting::find('1');
        return view('index', compact('categories', 'user_session', 'freshproject', 'pages', 'general_setting', 'project', 'blogs'));
    }
    public function projects()
    {


        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = 'Projects';

        $campaigns = Campaign::all();
        $pages = Page::all();
        return view('list', compact('campaigns', 'user_session', 'title', 'pages'));
    }
    public function project_category($category)
    {
        $campaigns = Campaign::join('categories', 'campaigns.category_id', '=', 'categories.id')
            ->where('categories.name', $category)
            ->select('campaigns.*')
            ->paginate(10);

        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = $category;

        $pages = Page::all();
        return view('project_category', compact('campaigns', 'title', 'user_session', 'pages'));
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
        $this->sendForApi($text, 1, $target_url, $user->id,$user->id);
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
        $general_setting = GeneralSetting::find('1');
        return view('appointment', compact('campaign', 'user_session', 'projects', 'general_setting', 'pages'));
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
        $pages = Page::all();
        return view('post', compact('countries', 'category', 'pages'));
    }
    public function ProjectStore(Request $request)
    {

        $rules = [
            'category' => 'required',
            'title' => 'required',
            'image' => 'required',
            'og_image' => 'required',
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
            'recommended_amount' => $request->recommended_amount,
            'amount_prefilled' => $request->amount_prefilled,
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
        // dd($request->all());
        if ($create) {
            return back()->with('success', 'Project Created');
        }

        return back()->with('fail', 'Something went wrong');
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

        return view('change_password', compact('user_session'));
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
