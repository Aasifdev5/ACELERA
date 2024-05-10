<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Currency;
use App\Models\FaqQuestion;
use App\Models\InstructorFeature;
use App\Models\InstructorProcedure;
use App\Models\Language;
use App\Models\Meta;
use App\Models\Package;
use App\Models\Setting;
use App\Models\SupportTicketQuestion;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Response;
use Spatie\Sitemap\SitemapGenerator;

class SettingController extends Controller
{
    use General, ImageSaveTrait;

    protected $metaModel;

    public function __construct(Meta $meta)
    {
        $this->metaModel = new Crud($meta);
    }

    public function GeneralSetting()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'General Setting';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['generalSettingsActiveClass'] = 'active';
            $data['currencies'] = Currency::all();
            $data['current_currency'] = Currency::where('current_currency', 'on')->first();
            $data['languages'] = Language::all();
            $data['default_language'] = Language::where('default_language', 'on')->first();

            return view('admin.application_settings.general.general-settings', $data);
        } else {
            return redirect()->route('login');
        }
    }

    public function GeneralSettingUpdate(Request $request)
    {
        $inputs = Arr::except($request->all(), ['_token']);
        $keys = [];

        foreach ($inputs as $k => $v) {
            $keys[$k] = $k;
        }

        foreach ($inputs as $key => $value) {
            $option = Setting::firstOrCreate(['option_key' => $key]);
            if ($request->hasFile('app_logo') && $key == 'app_logo') {
                $request->validate([
                    'app_logo' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('app_logo'));
                $option->option_value = $this->saveImage('setting', $request->app_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('app_black_logo') && $key == 'app_black_logo') {
                $request->validate([
                    'app_black_logo' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('app_black_logo'));
                $option->option_value = $this->saveImage('setting', $request->app_black_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('app_fav_icon') && $key == 'app_fav_icon') {
                $request->validate([
                    'app_fav_icon' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('app_fav_icon'));
                $option->option_value = $this->saveImage('setting', $request->app_fav_icon, null, null);
                $option->save();
            } elseif ($request->hasFile('app_footer_payment_image') && $key == 'app_footer_payment_image') {
                $request->validate([
                    'app_footer_payment_image' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('app_footer_payment_image'));
                $option->option_value = $this->saveImage('setting', $request->app_footer_payment_image, null, null);
                $option->save();
            } elseif ($request->hasFile('app_pwa_icon') && $key == 'app_pwa_icon') {
                $request->validate([
                    'app_pwa_icon' => 'mimes:png|dimensions:width=512,height=512'
                ]);
                $this->deleteFile(get_option('app_pwa_icon'));
                $option->option_value = $this->saveImage('setting', $request->app_pwa_icon, null, null);
                $option->save();
            } elseif ($request->hasFile('app_preloader') && $key == 'app_preloader') {
                $request->validate([
                    'app_preloader' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('app_preloader'));
                $option->option_value = $this->saveImage('setting', $request->app_preloader, null, null);
                $option->save();
            } elseif ($request->hasFile('faq_image') && $key == 'faq_image') {
                $request->validate([
                    'faq_image' => 'mimes:png,jpg,jpeg|dimensions:min_width=650,min_height=650,max_width=650,max_height=650'
                ]);
                $this->deleteFile('faq_image');
                $option->option_value = $this->saveImage('setting', $request->faq_image, null, null);
                $option->save();
            } elseif ($request->hasFile('home_special_feature_first_logo') && $key == 'home_special_feature_first_logo') {
                $request->validate([
                    'home_special_feature_first_logo' => 'mimes:png|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_first_logo'));
                $option->option_value = $this->saveImage('setting', $request->home_special_feature_first_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('home_special_feature_second_logo') && $key == 'home_special_feature_second_logo') {
                $request->validate([
                    'home_special_feature_second_logo' => 'mimes:png|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_second_logo'));
                $option->option_value = $this->saveImage('setting', $request->home_special_feature_second_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('home_special_feature_third_logo') && $key == 'home_special_feature_third_logo') {
                $request->validate([
                    'home_special_feature_third_logo' => 'mimes:png|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_third_logo'));
                $option->option_value = $this->saveImage('setting', $request->home_special_feature_third_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('course_logo') && $key == 'course_logo') {
                $request->validate([
                    'course_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('course_logo'));
                $option->option_value = $this->saveImage('setting', $request->course_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('product_section_logo') && $key == 'product_section_logo') {
                $request->validate([
                    'product_section_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('product_section_logo'));
                $option->option_value = $this->saveImage('setting', $request->product_section_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('category_course_logo') && $key == 'category_course_logo') {
                $request->validate([
                    'category_course_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('category_course_logo'));
                $option->option_value = $this->saveImage('setting', $request->category_course_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('upcoming_course_logo') && $key == 'upcoming_course_logo') {
                $request->validate([
                    'upcoming_course_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('upcoming_course_logo'));
                $option->option_value = $this->saveImage('setting', $request->upcoming_course_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('bundle_course_logo') && $key == 'bundle_course_logo') {
                $request->validate([
                    'bundle_course_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('bundle_course_logo'));
                $option->option_value = $this->saveImage('setting', $request->bundle_course_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('top_category_logo') && $key == 'top_category_logo') {
                $request->validate([
                    'top_category_logo' => 'mimes:png|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('top_category_logo'));
                $option->option_value = $this->saveImage('setting', $request->top_category_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('top_instructor_logo') && $key == 'top_instructor_logo') {
                $request->validate([
                    'top_instructor_logo' => 'mimes:png|dimensions:min_width=70,min_height=70,max_width=70,max_height=70'
                ]);
                $this->deleteFile(get_option('top_instructor_logo'));
                $option->option_value = $this->saveImage('setting', $request->top_instructor_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('become_instructor_video_logo') && $key == 'become_instructor_video_logo') {
                $request->validate([
                    'become_instructor_video_logo' => 'mimes:png|dimensions:min_width=70,min_height=70,max_width=70,max_height=70'
                ]);
                $this->deleteFile(get_option('become_instructor_video_logo'));
                $option->option_value = $this->saveImage('setting', $request->become_instructor_video_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('customer_say_logo') && $key == 'customer_say_logo') {
                $request->validate([
                    'customer_say_logo' => 'mimes:png|dimensions:min_width=64,min_height=64,max_width=64,max_height=64'
                ]);
                $this->deleteFile(get_option('customer_say_logo'));
                $option->option_value = $this->saveImage('setting', $request->customer_say_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('customer_say_first_image') && $key == 'customer_say_first_image') {
                $request->validate([
                    'customer_say_first_image' => 'mimes:png'
                ]);
                $this->deleteFile(get_option('customer_say_first_image'));
                $option->option_value = $this->saveImage('setting', $request->customer_say_first_image, null, null);
                $option->save();
            } elseif ($request->hasFile('customer_say_second_image') && $key == 'customer_say_second_image') {
                $request->validate([
                    'customer_say_second_image' => 'mimes:png'
                ]);
                $this->deleteFile(get_option('customer_say_second_image'));
                $option->option_value = $this->saveImage('setting', $request->customer_say_second_image, null, null);
                $option->save();
            } elseif ($request->hasFile('customer_say_third_image') && $key == 'customer_say_third_image') {
                $request->validate([
                    'customer_say_third_image' => 'mimes:png'
                ]);
                $this->deleteFile(get_option('customer_say_third_image'));
                $option->option_value = $this->saveImage('setting', $request->customer_say_third_image, null, null);
                $option->save();
            } elseif ($request->hasFile('customer_say_fourth_image') && $key == 'customer_say_fourth_image') {
                $request->validate([
                    'customer_say_fourth_image' => 'mimes:png'
                ]);
                $this->deleteFile(get_option('customer_say_fourth_image'));
                $option->option_value = $this->saveImage('setting', $request->customer_say_fourth_image, null, null);
                $option->save();
            } elseif ($request->hasFile('achievement_first_logo') && $key == 'achievement_first_logo') {
                $request->validate([
                    'achievement_first_logo' => 'mimes:png|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_first_logo'));
                $option->option_value = $this->saveImage('setting', $request->achievement_first_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('achievement_second_logo') && $key == 'achievement_second_logo') {
                $request->validate([
                    'achievement_second_logo' => 'mimes:png|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_second_logo'));
                $option->option_value = $this->saveImage('setting', $request->achievement_second_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('achievement_third_logo') && $key == 'achievement_third_logo') {
                $request->validate([
                    'achievement_third_logo' => 'mimes:png|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_third_logo'));
                $option->option_value = $this->saveImage('setting', $request->achievement_third_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('achievement_four_logo') && $key == 'achievement_four_logo') {
                $request->validate([
                    'achievement_four_logo' => 'mimes:png|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_four_logo'));
                $option->option_value = $this->saveImage('setting', $request->achievement_four_logo, null, null);
                $option->save();
            } elseif ($request->hasFile('sign_up_left_image') && $key == 'sign_up_left_image') {
                $request->validate([
                    'sign_up_left_image' => 'mimes:png,svg'
                ]);
                $this->deleteFile(get_option('sign_up_left_image'));
                $option->option_value = $this->saveImage('setting', $request->sign_up_left_image, null, null);
                $option->save();
            } elseif ($request->hasFile('become_instructor_video_preview_image') && $key == 'become_instructor_video_preview_image') {
                $request->validate([
                    'become_instructor_video_preview_image' => 'mimes:png|dimensions:min_width=835,min_height=630,max_width=835,max_height=630'
                ]);
                $this->deleteFile(get_option('become_instructor_video_preview_image'));
                $option->option_value = $this->saveImage('setting', $request->become_instructor_video_preview_image, null, null);
                $option->save();
            } elseif ($request->hasFile('become_instructor_video') && $key == 'become_instructor_video') {
                $this->deleteVideoFile(get_option('become_instructor_video'));

                $file_details = $this->uploadFileWithDetails('setting', $request->become_instructor_video);
                if (!$file_details['is_uploaded']) {
                    $this->showToastrMessage('error', __('Something went wrong! Failed to upload file'));
                    return redirect()->back();
                }

                $option->option_value = $file_details['path'];
                $option->save();
            } elseif ($request->hasFile('certificate_font') && $key == 'certificate_font') {
                $this->deleteVideoFile(get_option('certificate_font'));

                $file_details = $this->uploadFontInLocal('setting', $request->certificate_font, 'certificate_font.ttf');
                if (!$file_details['is_uploaded']) {
                    $this->showToastrMessage('error', __('Something went wrong! Failed to upload file'));
                    return redirect()->back();
                }

                $option->option_value = $file_details['path'];
                $option->save();
            } elseif ($key == 'TIMEZONE' || $key == 'FORCE_HTTPS') {

                setEnvironmentValue($key, $value);

                $option->option_value = $value;
                $option->save();
            } else {
                $option->option_value = $value;
                $option->save();
            }
        }

        if ($request->currency_id) {
            Currency::where('id', $request->currency_id)->update(['current_currency' => 'on']);
            Currency::where('id', '!=', $request->currency_id)->update(['current_currency' => 'off']);
        }

        /**  ====== Set Language ====== */
        if ($request->language_id) {
            Language::where('id', $request->language_id)->update(['default_language' => 'on']);
            Language::where('id', '!=', $request->language_id)->update(['default_language' => 'off']);
            $language = Language::where('default_language', 'on')->first();
            if ($language) {
                $ln = $language->iso_code;
                session(['local' => $ln]);
                App::setLocale(session()->get('local'));
            }
        }

        $this->showToastrMessage('success', __('Successfully Updated'));
        Artisan::call('optimize:clear');



        return redirect()->back();
    }

    // public function siteShareContent()
    // {
    //     $data['title'] = 'Site Share Content Setting';
    //     $data['navApplicationSettingParentActiveClass'] = 'mm-active';
    //     $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
    //     $data['siteShareContentActiveClass'] = 'active';
    //     return view('admin.application_settings.general.site-share-content', $data);
    // }

    public function mapApiKey()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Map Api Key Setting';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['siteMapApiKeyActiveClass'] = 'active';
            return view('admin.application_settings.general.map-api-key', $data);
        }
    }






    public function socialLoginSettings()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Social Login Setting';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['socialLoginSettingsActiveClass'] = 'active';
            return view('admin.application_settings.general.social-login-settings', $data);
        }
    }

    public function socialLoginSettingsUpdate(Request $request)
    {
        $values['GOOGLE_LOGIN_STATUS'] = $request->GOOGLE_LOGIN_STATUS;
        $values['GOOGLE_CLIENT_ID'] = $request->GOOGLE_CLIENT_ID;
        $values['GOOGLE_CLIENT_SECRET'] = $request->GOOGLE_CLIENT_SECRET;
        $values['GOOGLE_REDIRECT_URL'] = $request->GOOGLE_REDIRECT_URL;

        $values['FACEBOOK_LOGIN_STATUS'] = $request->FACEBOOK_LOGIN_STATUS;
        $values['FACEBOOK_CLIENT_ID'] = $request->FACEBOOK_CLIENT_ID;
        $values['FACEBOOK_CLIENT_SECRET'] = $request->FACEBOOK_CLIENT_SECRET;
        $values['FACEBOOK_REDIRECT_URL'] = $request->FACEBOOK_REDIRECT_URL;

        $values['TWITTER_LOGIN_STATUS'] = $request->TWITTER_LOGIN_STATUS;
        $values['TWITTER_CLIENT_ID'] = $request->TWITTER_CLIENT_ID;
        $values['TWITTER_CLIENT_SECRET'] = $request->TWITTER_CLIENT_SECRET;
        $values['TWITTER_REDIRECT_URL'] = $request->TWITTER_REDIRECT_URL;


        //        $envFile = app()->environmentFilePath();
        //        $str = file_get_contents($envFile);
        //        if (count($values) > 0) {
        //            foreach ($values as $envKey => $envValue) {
        //                $str .= "\n";
        //                $keyPosition = strpos($str, "{$envKey}=");
        //                $endOfLinePosition = strpos($str, "\n", $keyPosition);
        //                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        //
        //                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
        //                    $str .= "{$envKey}=\"{$envValue}\"\n";
        //                } else {
        //                    $str = str_replace($oldLine, "{$envKey}=\"{$envValue}\"", $str);
        //                }
        //            }
        //        }
        //        $str = substr($str, 0, -1);
        //        if (!file_put_contents($envFile, $str))
        //            return false;

        Artisan::call('optimize:clear');
        $this->showToastrMessage('success', __('Successfully Updated'));
        return redirect()->back();
    }




    public function metaIndex()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = __('Meta Management');
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['metaIndexActiveClass'] = 'active';

            $data['metas'] = $this->metaModel->getOrderById('DESC', 25);
            return view('admin.application_settings.meta_manage.index', $data);
        }
    }

    public function editMeta($uuid)
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = __('Edit Meta');
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['metaIndexActiveClass'] = 'active';
            $data['meta'] = $this->metaModel->getRecordByUuid($uuid);
            return view('admin.application_settings.meta_manage.edit', $data);
        }
    }

    public function updateMeta(Request $request, $uuid)
    {
        $data = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword
        ];

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $this->saveImage('meta', $request->og_image, null, null);
        }

        $this->metaModel->updateByUuid($data, $uuid);
        toastrMessage('success', 'Successfully Saved');
        return redirect()->route('settings.meta.index');
    }

    public function paymentMethod()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Payment Method Setting';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavPaymentOptionsSettingsActiveClass'] = 'mm-active';
            $data['paymentMethodSettingsActiveClass'] = 'active';
            return view('admin.application_settings.payment-method', $data);
        }
    }

    public function mailConfiguration()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Mail Configuration';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavMailConfigSettingsActiveClass'] = 'mm-active';
            $data['mailConfigSettingsActiveClass'] = 'active';
            return view('admin.application_settings.mail-configuration', $data);
        }
    }

    public function sendTestMail(Request $request)
    {
        $data = $request;

        try {
            Mail::to($request->to)->send(new TestMail($data));
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                toastrMessage('error', $exception->getMessage());
            } else {
                toastrMessage('error', 'Something is wrong. Please check your email settings');
            }
            return redirect()->back();
        }

        toastrMessage('success', 'Mail Successfully send.');
        return redirect()->back();
    }

    public function saveSetting(Request $request)
    {
        $this->updateSettings($request);
        $this->showToastrMessage('success', __('Successfully Saved'));
        return redirect()->back();
    }

    private function updateSettings($request)
    {
        $inputs = Arr::except($request->all(), ['_token']);
        $keys = [];

        foreach ($inputs as $k => $v) {
            $keys[$k] = $k;
        }
        foreach ($inputs as $key => $value) {

            $option = Setting::firstOrCreate(['option_key' => $key]);
            $option->option_value = $value;
            $option->save();
            setEnvironmentValue($key, $value);
        }

        Artisan::call('optimize:clear');
    }



    public function faqCMS()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'FAQ CMS';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavFAQSettingsActiveClass'] = 'mm-active';
            $data['faqCMSSettingsActiveClass'] = 'active';

            return view('admin.application_settings.faq.cms', $data);
        }
    }

    public function faqTab()
    {

        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'FAQ Tab';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavFAQSettingsActiveClass'] = 'mm-active';
            $data['faqCMSTabActiveClass'] = 'active';

            return view('admin.application_settings.faq.tab-service', $data);
        }
    }

    public function faqQuestion()
    {

        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'FAQ Question & Answer';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavFAQSettingsActiveClass'] = 'mm-active';
            $data['faqQuestionActiveClass'] = 'active';
            $data['faqQuestions'] = FaqQuestion::all();

            return view('admin.application_settings.faq.question', $data);
        }
    }

    public function faqQuestionUpdate(Request $request)
    {


        $now = now();
        if ($request['question_answers']) {
            if (count(@$request['question_answers']) > 0) {
                foreach ($request['question_answers'] as $question_answers) {
                    if (@$question_answers['question']) {
                        if (@$question_answers['id']) {
                            $question_answer = FaqQuestion::find($question_answers['id']);
                        } else {
                            $question_answer = new FaqQuestion();
                        }
                        $question_answer->question = @$question_answers['question'];
                        $question_answer->answer = @$question_answers['answer'];
                        $question_answer->updated_at = $now;
                        $question_answer->save();
                    }
                }
            }
        }

        FaqQuestion::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $q->delete();
        });

        $this->showToastrMessage('success', __('Updated Successful'));
        return redirect()->back();
    }

    public function supportTicketCMS()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Support Ticket CMS';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavSupportSettingsActiveClass'] = 'mm-active';
            $data['supportCMSSettingsActiveClass'] = 'active';

            return view('admin.application_settings.support_ticket.cms', $data);
        }
    }

    public function supportTicketQuesAns()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Support Ticket Question & Answer';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavSupportSettingsActiveClass'] = 'mm-active';
            $data['supportQuestionActiveClass'] = 'active';
            $data['supportTickets'] = SupportTicketQuestion::all();

            return view('admin.application_settings.support_ticket.question', $data);
        }
    }

    public function supportTicketQuesAnsUpdate(Request $request)
    {
        $now = now();
        if ($request['question_answers']) {
            if (count(@$request['question_answers']) > 0) {
                foreach ($request['question_answers'] as $question_answers) {
                    if (@$question_answers['question']) {
                        if (@$question_answers['id']) {
                            $question_answer = SupportTicketQuestion::find($question_answers['id']);
                        } else {
                            $question_answer = new SupportTicketQuestion();
                        }
                        $question_answer->question = @$question_answers['question'];
                        $question_answer->answer = @$question_answers['answer'];
                        $question_answer->updated_at = $now;
                        $question_answer->save();
                    }
                }
            }
        }

        SupportTicketQuestion::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $q->delete();
        });

        $this->showToastrMessage('success', __('Updated Successful'));
        return redirect()->back();
    }



    public function deviceControl()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Device Control Settings';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
            $data['deviceControlActiveClass'] = 'active';

            return view('admin.application_settings.device_control', $data);
        }
    }





    public function deviceControlChange(Request $request)
    {
        $request->validate([
            'device_limit' => 'required|integer|min:1',
        ]);

        $option = Setting::firstOrCreate(['option_key' => 'device_limit']);
        $option->option_value = $request->device_limit;
        $option->save();

        $option = Setting::firstOrCreate(['option_key' => 'device_control']);
        $option->option_value = $request->device_control;
        $option->save();

        $this->showToastrMessage('success', 'Device Control has been changed');
        return redirect()->back();
    }


    public function generateSiteMap()
    {
        set_time_limit(1200);
        SitemapGenerator::create(url(''))->writeToFile(public_path('uploads/sitemap.xml'));
        $filepath = public_path('uploads/sitemap.xml');
        return Response::download($filepath);
    }
}
