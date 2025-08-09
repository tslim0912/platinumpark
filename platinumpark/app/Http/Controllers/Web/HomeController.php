<?php

namespace App\Http\Controllers\Web;

// use App\Mail\CafeAndCorporate;
// use Illuminate\Contracts\Mail\Mailable;


use App\Asset;
use App\Mail\Book;
use App\LifestyleGallery;
use App\Lifestyle;
use App\WellnessGallery;
use App\Wellness;
use App\Mail\Enquiry;
use App\Mail\BookUser;
use Input, DB, Redirect;
use App\Mail\EnquiryUser;
use Illuminate\Http\Request;
use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        return view("web.pages.index");
    }

    public function lifestyle_search(Request $request)
	{       

        $keyword = $request->get('keyword');

        if($keyword) {
            $lifestyle_list = Lifestyle::where('title','LIKE','%'.$keyword.'%')->paginate(9);

            $lifestyle_list->appends(["keyword" => $keyword, "sort" => $request->get('sort')]);
        } else {
            return redirect()->back()->with("error", "Please enter a keyword to begin your search.");
        }

        return view('web.pages.lifestyle-search')->with( compact('lifestyle_list') );

	}
    
    public function business()
    {
        return view("web.pages.business");
    }

    public function conveniences()
    {
        return view("web.pages.conveniences");
    }

    public function aboutUs()
    {
        return view("web.pages.about-us");
    }

    public function whatsOn()
    {
        return view("web.pages.whats-on");
    }

    public function lifestyle()
    {   
        $lifestyle = Lifestyle::orderBy('created_at', 'asc')->get();

        return view("web.pages.lifestyle", compact('lifestyle'));
    }

    public function lifestyleDetail($slug)
    {
        $lifestyle = Lifestyle::where('slug', $slug)->first();

        $lifestyleGallery = LifestyleGallery::where('lifestyle_id', $lifestyle->id)->orderBy('sort', 'asc')->get();

        return view("web.pages.lifestyle-detail", compact('lifestyle','lifestyleGallery'));
    }  

    // Create a new page Wellness clone by Lifestyle
    public function wellness()
    {   
        $wellness = Wellness::orderBy('created_at', 'asc')->get();

        return view("web.pages.wellness", compact('wellness'));
    }

    public function wellnessDetail($slug)
    {
        $wellness = Wellness::where('slug', $slug)->first();

        $wellnessGallery = WellnessGallery::where('wellness_id', $wellness->id)->orderBy('sort', 'asc')->get();

        return view("web.pages.wellness-detail", compact('wellness','wellnessGallery'));
    }  

    public function contact()
    {
        return view("web.pages.contact");
    }

    public function enquiry()
    {
        return view("web.pages.enquiry");
    }

    public function storeEnquiry(Request $request)
    {
       
        $rules = [
            "gender" => "required",
            "contact" => "required|regex:/^[0-9]+$/",
            "first_name" => "required",
            // "last_name" => "required",
            "email" => "required|email",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if( request()->get("type") == 'enquiry')  {
            $email = 'hello@platinumpark.com.my';
        } else if (request()->get("type") == 'food') {
            $email = 'hello@platinumpark.com.my';
        } else if (request()->get("type") == 'leasing') {
            $email = 'hello@platinumpark.com.my';
        } else if (request()->get("type") == 'events') {
            $email = 'hello@platinumpark.com.my';
        }

        $data = [
            "first_name" => request()->get("first_name"),
            // "last_name" => request()->get("last_name"),
            "email" => request()->get("email"),
            "contact" => request()->get("contact"),
            "gender" => request()->get("gender"),
            "services" => request()->get("services"),
            // "inquiry" => request()->get("inquiry"),
            "asset_checkbox" => request()->get("asset_checkbox"),
            'admin_email' =>  $email,
        ];

        // dd(config('mail.from.name'), config('mail.from.address'));


        // send email

        Mail::to($email)
        ->send(new Enquiry($data));

        Mail::to(request()->get("email"))->send(new EnquiryUser($data));

        $message = 'Thank you for writing to us and we will be in touch with you within 3 business day.';

        


        Session::flash("success", $message);
        return redirect()->route("enquiry");
    }


    public function termsConditions()
    {
        return view("web.pages.terms-and-conditions");
    }

    public function privacyPolicy()
    {
        return view("web.pages.privacy-policy");
    }


}
